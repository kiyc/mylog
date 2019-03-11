<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm4>
      <v-card>
        <v-flex class="pa-3">
          <h3 class="display-1 text-center mb-4">Create Log</h3>
          <v-layout row wrap>
            <v-flex>
              <v-menu
                ref="date"
                :close-on-content-click="false"
                v-model="date"
                :return-value.sync="form.date"
                lazy
                full-width
                transition="scala-transition"
                >
                <v-text-field
                  slot="activator"
                  v-model="form.date"
                  label="Date"
                  prepend-icon="event"
                  readonly
                  :error-messages="errors.date"
                  >
                </v-text-field>
                <v-date-picker
                  no-title
                  v-model="form.date"
                  @input="$refs.date.save(form.date)"
                  >
                </v-date-picker>
              </v-menu>
            </v-flex>
          </v-layout>
          <v-textarea
            label="Diary"
            v-model="form.diary"
            :error-messages="errors.diary"
            >
          </v-textarea>
          <v-layout>
            <v-flex class="text-xs-right">
              <v-btn primary large @click="save">Save</v-btn>
            </v-flex>
          </v-layout>
        </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data () {
    return {
      form: {
        date: '',
        diary: '',
      },
      date: false,
      errors: [],
    }
  },
  methods: {
    save () {
      const url = '/api/user_logs';
      const data = this.form;

      axios.post(url, data)
        .then( response => {
          this.$router.push('/home');
        })
        .catch( error => {
          this.errors = error.response.data.errors;
          console.log(error);
        });
    },
  },
}
</script>
