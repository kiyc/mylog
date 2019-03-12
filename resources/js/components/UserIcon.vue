<template>
  <v-avatar
      size="42"
      color="amber lighten-2"
      >
      <img v-if="user && user.avatar" :src="user.avatar" alt="avatar">
      <v-icon v-else dark>account_circle</v-icon>
  </v-avatar>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'user-icon',

  computed: mapState(['user']),
  mounted () {
    if (!this.user) {
      this.$store.dispatch('initUser');
    }
  },
}
</script>