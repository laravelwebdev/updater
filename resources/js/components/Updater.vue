<template>
  <div class="relative">
    <Button
      variant="action"
      :icon="buttonIcon"
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
      buttonIcon: 'inbox-arrow-down'
    }
  },
  methods:{
    update() {
      if (confirm('Apakah Anda Ingin Mengupdate Aplikasi Simpede?') === true){
      Nova.success('Proses Update Sedang Berlangsung. Silakan Tunggu..');
      this.buttonIcon = 'play-circle';
        Nova.request().post('/nova-vendor/updater/update').then(response => {
          if (response.data.status === true) {
            Nova.success('Update berhasil!');
          } else {
            Nova.error('Update gagal!');
          }
          this.buttonIcon = 'inbox-arrow-down';
        });
      }
    },
  }
}
</script>
