<template>
    <v-app>
      <v-navigation-drawer class="" color="harper" v-model="drawer" app>
        <v-btn elevation="0" color="harper" icon @click.stop="drawer = !drawer">
          <v-icon>{{ drawer ? 'mdi-arrow-expand-left' : 'mdi-arrow-expand-right' }}</v-icon>
        </v-btn>
  
        <v-list dense nav>
          <v-list-item
            v-for="item in itemsMenu"
            :key="item.name"
            :value="item.link"
            :href="item.link"
            @click="toggleSubItems(item)"
          >
            <div class="d-flex">
                <v-icon
      size="large"
      :icon="item.icon"
    ></v-icon>
          {{ item.name }}
            </div>
            <template v-if="item.childs">
              <v-list-item
                v-for="child in item.childs"
                :key="child.name"
                :title="child.name"
                :to="child.link"
              ></v-list-item>
            </template>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
  
      <v-app-bar app>
        <v-app-bar-nav-icon v-if="!drawer" @click="toggleSidebar"></v-app-bar-nav-icon>
        <v-app-bar-title>Harper Marketing inventory</v-app-bar-title>
      </v-app-bar>
  
      <v-main>
        <v-container fluid>
          <router-view></router-view>
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script setup>
  import "@mdi/font/css/materialdesignicons.css";
  import { ref } from "vue";
  
  const itemsMenu = [
    {
      name: "Home",
      icon: "mdi-view-dashboard",
      link: "/",
    },
    {
      name: "Products",
      icon: "mdi-view-dashboard",
      link: "/products",
      childs: [
        {
          name: "Request Product",
          link: "/products/request",
        },
        {
          name: "Record Movement of Product",
          link: "/products/movements",
        },
      ],
    },
  ];
  
  const drawer = ref(true);
  
  const toggleSidebar = () => {
    drawer.value = !drawer.value;
  };
  
  const toggleSubItems = (item) => {
    if (item.childs) {
      item.opened = !item.opened; // Add an 'opened' property to track the open state
    }
  };
  </script>
  
  <style>
  /* Add any necessary styles here */
  </style>
  