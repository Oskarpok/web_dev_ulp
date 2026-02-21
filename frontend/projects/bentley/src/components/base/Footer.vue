<script setup>
  import { RouterLink } from 'vue-router'

  const footerSections = [
    {
      title: 'MODELS',
      links: ['Continental GT', 'Flying Spur', 'Bentayga', 'Mulliner']
    },
    {
      title: 'SERVICES',
      links: ['Configurator', 'Test Drive', 'Pre-owned', 'Servicing']
    },
    {
      title: 'WORLD OF BENTLEY',
      links: ['Our Story', 'News', 'Heritage', 'Sustainability']
    },
    {
      title: 'LEGAL',
      links: ['Privacy Policy', 'Cookies', 'Terms & Conditions']
    },
    {
      title: 'CONTACT',
      links: ['Find a Dealer', 'Contact Us', 'Careers']
    }
  ]
</script>

<template>
  <footer class="w-full bg-white text-black mt-8">
    <div class="grid grid-cols-5 gap-8 border-t border-b border-black py-8 
      tracking-widest uppercase px-12 justify-items-center">
      
      <div v-for="section in footerSections" :key="section.title" 
        class="flex flex-col gap-6 items-center text-center">
        <h3 class="text-[12px] font-bold">{{ section.title }}</h3>
        <div class="flex flex-col gap-4">
          <RouterLink 
            v-for="link in section.links" 
            :key="link" 
            to="/" 
            class="text-[10px] hover:text-gray-400 transition-colors">
            {{ link }}
          </RouterLink>
        </div>
      </div>
    </div>

    <div class="mt-8 flex justify-center text-[10px] tracking-[0.2em] 
      text-gray-500 uppercase">

      <div class="flex gap-6">
        <span>Ytube</span>
        <span>Likteen</span>
        <span>Dretonote</span>
      </div>
      <div> © 2026 Bentley Motors </div>

      <div class="flex gap-6">
        <span>Instagram</span>
        <span>Twitter</span>
        <span>Facebook</span>
      </div>

    </div>
  </footer>
</template>

<style scoped>

</style>