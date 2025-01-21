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
      buttonIcon: 'arrow-path'
    }
  },
  methods:{
    update() {
      this.buttonIcon = 'play-circle';
        Nova.request().post('/nova-vendor/updater/update').then(response => {
          alert(response.data.status);
          this.buttonIcon = 'arrow-path';
        });
    },
  }
}
</script>
