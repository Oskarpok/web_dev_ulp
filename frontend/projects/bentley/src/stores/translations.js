import { defineStore } from 'pinia';
import axios from 'axios';

export const TranslationStore = defineStore('translations', {
  state: () => ({
    texts: {},
    currentLang: 'pl',
    loading: false
  }),

  actions: {
    async fetchTranslations() {
      this.loading = true;
      try {
        const response = await axios.get('http://localhost:8081/admin/texts');
        // Zapisujemy 'data' z Twojego JSON-a
        this.texts = response.data.data;
      } catch (error) {
        console.error('Błąd pobierania tłumaczeń:', error);
      } finally {
        this.loading = false;
      }
    },

    setLanguage(lang) {
      this.currentLang = lang;
    }
  },

  getters: {
    // Magiczna funkcja 't', której będziesz używać w komponentach
    t: (state) => {
      return (key) => {
        // Sprawdza czy klucz istnieje i czy ma tłumaczenie w danym języku
        return state.texts[key]?.[state.currentLang] || key;
      };
    }
  }
});