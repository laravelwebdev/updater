<template>
  <div class="relative">
    <Button variant="action" icon="arrow-path" @click="update"> </Button>
  </div>
  <Modal v-if="showModal" size="'2xl'" role="alertdialog">
    <div
      class="mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden"
    >
      <slot>
        <ModalHeader v-text="Update Log" />
        <div class="py-3 px-8">
          <p>{{ output }}</p>
        </div>
      </slot>

      <ModalFooter>
        <div class="ml-auto">
          <Button
            variant="link"
            state="mellow"
            @click="showModal = false"
            class="mr-3"
            dusk="close-modal-button"
          >
            Close
          </Button>
        </div>
      </ModalFooter>
    </div>
  </Modal>
</template>

<script>
import { Button } from "laravel-nova-ui";
export default {
  name: "Updater",
  components: { Button },
  data() {
    return {
      showModal: false,
      output: "",
    };
  },
  methods: {
    update() {
      Nova.request()
        .post("/nova-vendor/updater/update")
        .then((response) => {
          this.output = response.data.output;
          this.showModal = true;
        });
    },
  },
};
</script>
