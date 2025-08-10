<template>
  <div class="relative">
    <Button
      variant="action"
      :icon="buttonIcon"
      :disabled="isDisabled"
      @click="update"
    >
    </Button>
  </div>
</template>

<script>
import { Button } from 'laravel-nova-ui'
export default {
  name: "Updater",
  components: { Button },
    data() {
    return {
      buttonIcon: 'arrow-path',
      isDisabled: false
    }
  },
  methods:{
    update() {
      Nova.success('Proses Update Sedang Berlangsung. Silakan Tunggu..');
      this.buttonIcon = 'no-symbol';
      this.isDisabled = true;
        Nova.request().post('/nova-vendor/updater/update').then(response => {
          if (response.data.status === true) {
            Nova.success('Update berhasil!');
          } else {
            Nova.error('Update gagal!');
          }
          this.buttonIcon = 'arrow-path';
          this.isDisabled = false;
        });      
    },
  }
}
</script>
