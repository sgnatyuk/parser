<template>
  <v-content>
    <v-container fluid>
      <v-data-table
          :headers="headers"
          :items="items"
          sort-by="calories"
          class="elevation-1"
      >
        <template v-slot:top>
          <v-toolbar flat color="white">
            <v-toolbar-title>Posts</v-toolbar-title>
            <v-divider
                class="mx-4"
                inset
                vertical
            ></v-divider>
          </v-toolbar>
        </template>

        <template v-slot:item.show="{ item }">
          <v-icon
              small
              class="mr-2"
              @click="open(item)"
          >
            mdi-eye
          </v-icon>
        </template>

      </v-data-table>
    </v-container>
  </v-content>
</template>

<script>

  import axios from '../plugins/axios'

  export default {
    beforeRouteEnter(_to, _from, next) {
      axios.get('/')
        .then(response => next(vm => vm.setData(response.data)))
    },
    created() {

      this.$http.get('/')
        .then(response => this.setData(response.data))

      window.Echo
        .channel('app')
        .listen('FinishedParsing', e => {
          this.setData(e.data)
          this.$root.loading = false

          console.log(e)
        })
    },

    data: () => ({
      items: [],
      headers: [
        { text: 'URL', value: 'url', sortable: false },
        { text: 'Title', value: 'title', sortable: false },
        { text: 'Show', value: 'show', sortable: false },
      ],
    }),
    methods: {
      setData(data) {
        this.items = data
      },
      open(item) {
        this.$router.push({ name: 'post', params: { id: item.id } })
      },
    },
  }
</script>