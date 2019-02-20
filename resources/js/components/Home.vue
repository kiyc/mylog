<template>
  <v-layout>
    <v-flex xs12 sm4 offset-sm4>
      <v-card>
        <v-btn fixed dark fab bottom right color="indigo">
          <v-icon>add</v-icon>
        </v-btn>
      </v-card>
      <v-card v-for="(log, idx) in userLogs" :key="idx" class="mb-4">
        <v-flex class="pa-3">
          <v-card-title class="pt-0 pb-0">
            <h3 class="display-1">{{ log.date }}</h3>
          </v-card-title>
          <v-card-text>
            <p>{{ log.diary }}</p>
            <v-divider class="mb-3"></v-divider>
          </v-card-text>
        </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import axios from 'axios';

export default {
  data () {
    return {
      userLogs: [],
    }
  },
  mounted: function () {
    this.getUserLogs();
  },
  methods: {
    getUserLogs () {
      const url = '/api/user_logs';
      axios.get(url)
        .then( response => {
          this.userLogs = response.data.user_logs;
        })
        .catch( error => {
          console.log(error);
        });
    },
  },
}
</script>
