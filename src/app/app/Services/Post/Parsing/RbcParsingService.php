<?php

namespace App\Services\Post\Parsing;

use Illuminate\Support\Facades\Log;
use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\HtmlNode;
use PHPHtmlParser\Dom\Collection;

use App\Domain\Uuid;
use App\Domain\Post\Entity\Post;

class RbcParsingService implements ParsingService
{
    public const SLEEP = .1;

    private $dom;

    public function __construct(Dom $dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return array|Post[]
     */
    public function parse(): array
    {
        try {
            $this->dom->loadFromUrl('https://www.rbc.ru/');

            $content = $this->dom->find('.news-feed__item.js-news-feed-item');

            sleep(self::SLEEP);

            $data = [];

            /* @var HtmlNode $item */
            foreach ($content as $item) {

                $parseUrl = parse_url($item->getAttribute('href') ?? '');

                try {

                    $url = $parseUrl['host'] . $parseUrl['path'];

                    $this->dom->loadFromUrl($url);

                    $title = $this->dom->find('.article__header__title .js-slide-title')[0]->innerHtml();

                    /* @var Collection $imgCollection */
                    $imgCollection = $this->dom->find('.article__main-image__image');

                    $image = null;
                    if ($imgCollection->count()) {
                        $image = $imgCollection[0]->getAttribute('src');
                    }

                    /* @var Collection $pCollection */
                    $pCollection = $this->dom->find('.article__text p');

                    $text = array_map(
                        function (HtmlNode $p) {
                            $value = strip_tags($p->innerHtml());
                            $value = preg_replace('/\s+/', ' ', $value);
                            $value = trim($value);

                            return $value;
                        },
                        $pCollection->toArray()
                    );

                    $short = trim(mb_strcut(implode(' ', $text), 0, 200)) . '...';

                    $data[] = new Post(
                        Uuid::next(),
                        $url,
                        $title,
                        $image,
                        $short,
                        $text
                    );

                } catch (\Throwable $e) {
                   Log::debug($e->getMessage(), $parseUrl);
                }

                sleep(self::SLEEP);
            }
        } catch (\Throwable $e) {
            throw $e;
        }

        return $data;
    }
}
