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
              <v-btn primary large @click="saveUserLog" :loading="submitLoading" :disabled="submitLoading">Save</v-btn>
            </v-flex>
          </v-layout>
        </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import { mapState, mapMutations, mapActions } from 'vuex';

export default {
  data () {
    return {
      date: false,
    }
  },
  computed: {
    ...mapState(['errors', 'submitLoading']),
    form: {
      get () {
        return this.$store.state.form;
      },
      set (newForm) {
        this.setForm(newForm);
      },
    },
  },
  mounted () {
    this.setRouter(this.$router);
    this.initEdit();
  },
  methods: {
    ...mapMutations(['setRouter', 'setForm']),
    ...mapActions(['initEdit', 'saveUserLog']),
  },
}
</script>
