<template>
  <v-app>
    <v-app-bar
        app
        color="primary"
        dark
    >
      <v-spacer></v-spacer>

      <v-btn
          @click="update"
          target="_blank"
          text
          :loading="isLoading"
      >
        <span class="mr-2">Update</span>
        <v-icon>mdi-open-in-new</v-icon>
      </v-btn>
    </v-app-bar>

    <router-view></router-view>
  </v-app>
</template>

<script>
  export default {
    name: 'App',
    data: () => ({}),
    computed: {
      isLoading() {
        return this.$root.loading
      },
    },
    methods: {
      update() {

        this.$http.get('save')
          .then(() => {
            this.$root.loading = true
          })
      },
    },
  }
</script>
