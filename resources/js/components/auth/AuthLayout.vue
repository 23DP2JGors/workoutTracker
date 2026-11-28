<template>
  <div class="auth-page" :class="`auth-page--${variant}`">
    <slot />
  </div>
</template>

<script setup>
defineProps({
  variant: {
    type: String,
    required: true,
    validator: value => ['login', 'register'].includes(value),
  },
})
</script>

<style scoped>
.auth-page {
    box-sizing: border-box;
    width: 100%;
    min-height: calc(100dvh - var(--v-layout-top, 0px));
    display: grid;
    place-items: center;
    padding: 24px;
    background:
        radial-gradient(
            circle at 50% 10%,
            color-mix(in srgb, rgb(var(--v-theme-primary)) 10%, transparent),
            transparent 44%
        ),
        rgb(var(--v-theme-background));
}

@media (max-width: 600px) {
    .auth-page {
        padding: 20px;
    }
}

@media (max-height: 720px) {
    .auth-page {
        padding-block: 12px;
    }
}
</style>
