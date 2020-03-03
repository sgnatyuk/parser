<template>
  <v-content>
    <v-container>
      <v-card
          class="mx-auto"
      >
        <v-img v-if="image"
               :src="image"
               height="400px"
        ></v-img>

        <v-card-title>
          {{ title }}
        </v-card-title>

        <v-card-subtitle>
          <a :href="url" target="_blank">{{ url }}</a>
        </v-card-subtitle>

        <v-card-text>
          <p v-for="(item, index) in text" :key="index">{{ item }}</p>
        </v-card-text>

      </v-card>
    </v-container>
  </v-content>
</template>

<script>
  import axios from '../plugins/axios'

  export default {
    beforeRouteEnter(_to, _from, next) {
      axios
        .get(`/posts/${_to.params.id}`)
        .then(response => next(vm => vm.setData(response.data)))
    },
    data: () => ({
      url: '',
      title: '',
      image: 'https://via.placeholder.com/600x200?text=NO%20IMAGE',
      text: [],
    }),
    methods: {
      setData(data) {
        this.url = 'https://' + data.url
        this.title = data.title
        this.image = data.image
        this.text = JSON.parse(data.text)
      },
    },
  }
</script>