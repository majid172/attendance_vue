import { defineStore } from "pinia";
import axios from "axios";
import router from "@/router";
export const useLoginStore = defineStore('loginStore',{
  state: ()=>({
    credentials: [],
    inputField:{
      email: '',
      password: ''
    }
  }),
  actions:{
    async login(){
      console.log(this.inputField);
      const {data} = await axios.post('/login',this.inputField);
      console.log(data);
      this.credentials = data.user;
      localStorage.setItem('token',data.access_token);
      axios.defaults.headers.common['Authorization'] = `Bearer ${data.access_token}`;

      router.push('/dashboard');
    },
    async logout()
    {
      try {
        const token = localStorage.getItem("token");

        if (!token) {
          console.warn("No token found, redirecting to login...");
          router.push("/");
          return;
        }

        await axios.post("/logout", {}, {
          headers: { Authorization: `Bearer ${token}` }
        });

        // Remove token & user data
        localStorage.removeItem("token");
        this.credentials = [];

        // Remove auth header globally
        delete axios.defaults.headers.common["Authorization"];

        // Redirect to login
        router.push("/");
      } catch (error) {
        console.error("Logout failed:", error);
      }
    }
  }
})
