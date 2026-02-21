<script setup>
import { ref, onMounted, watch } from 'vue'

const slides = [
  {
    id: 1,
    title: "THE NEW CONTINENTAL GT",
    // ZMIEŃ NA PLIK MP4 - linki do YouTube nie zadziałają w tagu <video>
    video: "https://v.ftm.bfmtv.com/6249514787001/202406/3321/6249514787001_6355606456001_6355606037001-vs.mp4", 
    description: "A NEW ERA OF EXTRAORDINARY PERFORMANCE."
  },
  {
    id: 2,
    title: "BENTAYGA EWB",
    video: "https://p-98-33.p3k.pro/bentley-hero-2.mp4",
    description: "CRAFTED FOR THE UNCOMPROMISING."
  }
]

const currentSlide = ref(0)
const displayedText = ref("")
let typeInterval = null

const typeWriter = (text) => {
  clearInterval(typeInterval)
  displayedText.value = ""
  let i = 0
  typeInterval = setInterval(() => {
    if (i < text.length) {
      displayedText.value += text.charAt(i)
      i++
    } else {
      clearInterval(typeInterval)
    }
  }, 70) 
}

onMounted(() => {
  typeWriter(slides[currentSlide.value].title)
})

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % slides.length
  typeWriter(slides[currentSlide.value].title)
}
</script>

<template>
  <main class="w-full bg-black">
    <section class="relative w-full h-[calc(100vh-92px)] overflow-hidden">
      
      <transition name="fade" mode="out-in">
        <video 
          :key="currentSlide"
          autoplay 
          muted 
          loop 
          playsinline
          class="absolute inset-0 w-full h-full object-cover opacity-50"
        >
          <source :src="slides[currentSlide].video" type="video/mp4">
          Twoja przeglądarka nie obsługuje wideo.
        </video>
      </transition>

      <div class="relative z-10 h-full flex items-center px-20">
        
        <div class="w-full flex justify-end">
          <div class="text-right max-w-3xl">
            <h1 class="text-white text-6xl font-light tracking-[0.3em] leading-tight mb-8 min-h-[180px]">
              {{ displayedText }}<span class="animate-pulse">_</span>
            </h1>
            
            <p class="text-gray-400 tracking-[0.2em] text-sm mb-12 uppercase italic">
              {{ slides[currentSlide].description }}
            </p>
            
            <button @click="nextSlide" class="group relative overflow-hidden border border-white/20 px-12 py-4 text-[10px] tracking-[0.4em] text-white uppercase transition-all hover:border-white">
              <span class="relative z-10">Explore Model</span>
              <div class="absolute inset-0 bg-white translate-y-full transition-transform duration-500 group-hover:translate-y-0"></div>
            </button>
          </div>
        </div>

        <div class="absolute left-12 top-1/2 -translate-y-1/2 flex flex-col gap-6">
          <button 
            v-for="(slide, index) in slides" 
            :key="index"
            @click="currentSlide = index; typeWriter(slides[index].title)"
            class="group flex items-center gap-4"
          >
            <span class="text-[10px] text-white transition-opacity duration-500" :class="currentSlide === index ? 'opacity-100' : 'opacity-0'">0{{index + 1}}</span>
            <div class="w-[1px] h-10 transition-all duration-700"
                 :class="currentSlide === index ? 'bg-white h-16' : 'bg-white/20'"></div>
          </button>
        </div>
      </div>

    </section>
  </main>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 1.2s ease-in-out;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>