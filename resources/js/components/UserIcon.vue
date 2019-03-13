<template>
  <v-avatar
      size="42"
      color="amber lighten-2"
      >
      <img v-if="user && user.icon" :src="user.icon" alt="avatar">
      <v-icon v-else dark>account_circle</v-icon>
  </v-avatar>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'user-icon',

  computed: mapState(['user']),
  mounted () {
    if (!this.user || !this.user.icon) {
      this.$store.dispatch('initUser');
    }
  },
}
</script>