<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm4>
      <v-card>
        <v-flex class="pa-3">
          <h3 class="display-1 text-center mb-4">Settings</h3>

          <v-text-field label="Name" v-model="form.name" :error-messages="errors.name"></v-text-field>

          <v-text-field label="Email" v-model="form.email" :error-messages="errors.email"></v-text-field>

          <v-text-field
            type="password"
            label="Password"
            v-model="form.password"
            :error-messages="errors.password"
          ></v-text-field>

          <div class="mt-3">
            <div v-if="icon.image || user.icon">
              <img :src="icon.image" v-if="icon.image">
              <img :src="user.icon" v-else-if="user.icon">
              <v-checkbox
                label="Delete icon image"
                true-value="1"
                valse-value="0"
                v-model="form.reset_icon"
                class="ma-0"
              ></v-checkbox>
            </div>
            <upload-btn
              color="primary"
              title="Select icon image file"
              :fileChangedCallback="uploadIcon"
            ></upload-btn>
            <v-messages :value="errors.icon" v-if="errors.icon" class="error--text"></v-messages>
          </div>
          <v-layout>
            <v-flex class="text-xs-right">
              <v-messages :value="messages" v-if="messages" class="info--text subheading mr-2"></v-messages>
              <v-btn
                primary
                large
                @click="saveSettings"
                :loading="submitLoading"
                :disabled="submitLoading"
              >Save</v-btn>
            </v-flex>
          </v-layout>
        </v-flex>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import { mapState, mapMutations, mapActions } from "vuex";
import UploadButton from "vuetify-upload-button";

export default {
  components: {
    "upload-btn": UploadButton
  },
  computed: {
    ...mapState(["messages", "errors", "submitLoading", "user", "icon"]),
    form: {
      get() {
        return this.$store.state.form;
      },
      set(newForm) {
        this.setForm(newForm);
      }
    }
  },
  mounted() {
    this.setRouter(this.$router);
    this.initSettings();
  },
  methods: {
    ...mapMutations(["setRouter", "setForm"]),
    ...mapActions(["initSettings", "saveSettings", "uploadIcon"])
  }
};
</script>
