import axios from "axios";

export const CustomAPI = axios.create({
  baseURL: '/api/v1/',
})