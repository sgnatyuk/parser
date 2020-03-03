FROM node:10-alpine

RUN apk add --update --no-cache bash

RUN yarn global add --prod --no-lockfile laravel-echo-server \
	&& yarn cache clean

CMD ["laravel-echo-server", "start"]