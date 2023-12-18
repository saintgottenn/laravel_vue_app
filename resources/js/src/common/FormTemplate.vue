<template>
  <div class="w-full flex justify-center pt-16">
    <div class="flex flex-col space-y-4 max-w-md w-full">
      <slot name="title"></slot>
      <slot name="fields"></slot>
      <slot name="errors"></slot>
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "FormTemplate",
};
</script>

<style scoped></style>
