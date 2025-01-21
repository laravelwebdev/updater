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
      this.buttonIcon = 'play-circle';
        Nova.request().post('/nova-vendor/updater/update').then(response => {
          alert(response.data.status);
          this.buttonIcon = 'inbox-arrow-down';
        });
      }
    },
  }
}
</script>
