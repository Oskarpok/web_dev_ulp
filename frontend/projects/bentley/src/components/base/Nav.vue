<script setup>
import { RouterLink } from 'vue-router'

const handleHover = (e) => {
  const el = e.currentTarget;
  el.classList.add('is-animating');
  
  setTimeout(() => {
    el.classList.remove('is-animating');
  }, 700);
}
</script>

<template>
  <nav class="flex items-center justify-between px-12 py-8 bg-[#0f172a] 
    text-white tracking-[0.3em] text-[11px] font-medium mb-8">
    <div class="flex-1 flex justify-start gap-12">
      <RouterLink v-for="link in [
        { name: 'MODELS', to: '/models' },
        { name: 'CONFIGURATOR', to: '/configurator' },
        { name: 'LOCATE DEALER', to: '/' }
      ]" :key="link.name" :to="link.to" 
      @mouseenter="handleHover"
      class="nav-link group relative py-2">
        {{ link.name }}
        <span class="line"></span>
      </RouterLink>
    </div>

    <div class="flex-none mx-12">
      <RouterLink to="/">
        <img src="https://www.bentleymotors.com/content/dam/bm/websites/bmcom/bentleymotors-com/logos/Simplified%20Negative_BMdotCom_1000x500_2x1.png/_jcr_content/renditions/original./Simplified%20Negative_BMdotCom_1000x500_2x1.png" 
          alt="Bentley" class="h-8 w-auto brightness-200">
      </RouterLink>
    </div>

    <div class="flex-1 flex justify-end gap-12">
      <RouterLink v-for="link in [
        { name: 'ABOUT US', to: '/' },
        { name: 'HELP', to: '/' },
        { name: 'EXPERIENCE', to: '/' }
      ]" :key="link.name" :to="link.to"
      @mouseenter="handleHover"
      class="nav-link group relative py-2">
        {{ link.name }}
        <span class="line"></span>
      </RouterLink>
    </div>
  </nav>
</template>

<style scoped>
  .nav-link {
    overflow: hidden;
  }

  .line {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: white;
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .nav-link:hover .line,
  .nav-link.is-animating .line {
    transform: scaleX(1);
    transform-origin: left;
  }

  .nav-link:not(:hover):not(.is-animating) .line {
    transform: scaleX(0);
    transform-origin: right;
  }
</style>