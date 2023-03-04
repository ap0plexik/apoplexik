<script setup>
import { Head } from "@inertiajs/vue3";
import SiteHeader from "@/Components/SyntaxTheme/SiteHeader.vue";
import Hero from "@/Components/SyntaxTheme/Hero.vue";
import NavLeft from "@/Components/SyntaxTheme/NavLeft.vue";
import NavRight from "@/Components/SyntaxTheme/NavRight.vue";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  title: String,
  leftNavData: Object,
});
</script>

<template>
  <div>
    <Head :title="title" />
    <SiteHeader :canLogin="canLogin" :canRegister="canRegister" />

    <!-- Page Heading -->
    <header v-if="$slots.header" class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>
    <!-- start body -->
    <div
      class="relative mx-auto flex max-w-8xl justify-center sm:px-2 lg:px-8 xl:px-12"
    >
      <NavLeft
        v-if="$page.props.leftNavData"
        :navData="$page.props.leftNavData"
      />
      <!-- start main -->
      <main
        class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pr-0 lg:pl-8 xl:px-16"
      >
        <slot />
      </main>
      <!-- end main -->
      <slot name="rightNav" />
    </div>
    <!-- end body -->
  </div>
</template>
