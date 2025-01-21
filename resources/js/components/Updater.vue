<template>
  <div class="relative">
    <Button
      variant="action"
      icon="arrow-path"
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
  methods:{
    update() {
        Nova.request().post('/nova-vendor/updater/update').then(response => {
          alert(response.data.status);
        });
    },
  }
}
</script>
