<template>
    <v-app>
        <v-navigation-drawer
            color="harper"
            v-model="drawer"
            app
            v-if="isUserLoggedIn"
        >
            <v-btn
                elevation="0"
                color="harper"
                icon
                @click.stop="drawer = !drawer"
            >
                <v-icon>{{
                    drawer ? "mdi-arrow-expand-left" : "mdi-arrow-expand-right"
                }}</v-icon>
            </v-btn>

            <v-list dense nav>
                <v-list-item
                    v-for="item in filteredItemsMenu"
                    :key="item.name"
                    :value="item.link"
                    :href="item.link"
                    @click="toggleSubItems(item)"
                >
                    <div class="d-flex">
                        <v-icon size="large" :icon="item.icon"></v-icon>
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

        <v-app-bar app v-if="isUserLoggedIn">
            <v-app-bar-nav-icon
                v-if="!drawer"
                @click="toggleSidebar"
            ></v-app-bar-nav-icon>
            <v-app-bar-title>Harper Marketing Inventory</v-app-bar-title>
        </v-app-bar>

        <v-main class="pa-5 md:pa-0">
            <v-container fluid>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script setup>
import { onMounted, ref, computed } from "vue";
import { useUserStore } from "./stores/user.store"; 
const userStore = useUserStore();
const isUserLoggedIn = computed(() => userStore.isUserLoggedIn);
const userRole = computed(() => userStore.userRole);
const drawer = ref(true);

const itemsMenu = [
    {
        name: "Home",
        icon: "mdi-view-dashboard",
        link: "/",
    },
    {
        name: "Products",
        icon: "mdi-apps-box",
        link: "/products",
        childs: [
            {
                name: "Request Product",
                link: "/products",
            },
            {
                name: "My Requests",
                link: "/requests/my-requests",
            },
            {
                name: "Pending Requests",
                link: "/requests/pending-requests",
            },
            {
                name: "All Requests",
                link: "/products/movements",
            },
        ],
    },
];

const filteredItemsMenu = computed(() => {
    if (userRole.value === "user") {
        return itemsMenu.map((item) => {
            if (item.name === "Products") {
                const filteredChilds = item.childs.filter(
                    (child) =>
                        child.name !== "Pending Requests" &&
                        child.name !== "All Requests"
                );
                return { ...item, childs: filteredChilds };
            }
            return item;
        });
    }
    return itemsMenu;
});

const toggleSidebar = () => {
    drawer.value = !drawer.value;
};

const toggleSubItems = (item) => {
    if (item.childs) {
        item.opened = !item.opened;
    }
};

onMounted(() => {
    userStore.setIslogged(true)
    localStorage.getItem("authToken") ? userStore.setIslogged(true) : userStore.setIslogged(false);
});
</script>

<style>
main.v-main {
    background-color: white;
}
</style>
