<template>
    <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      mode="inline"
    >
      <a-menu-item key="admin-users">
        <router-link :to="{ name: 'admin-users'}">
            <span> 
              <UserOutlined/> Tai Khoan
            </span>
        </router-link>
      </a-menu-item>
      <a-menu-item key="admin-roles">
        <router-link :to="{ name: 'admin-roles'}">
            <span>
              <TagOutlined/> Vai tro
            </span>
        </router-link>
      </a-menu-item>
      <a-menu-item key="admin-settings">
        <router-link :to="{ name: 'admin-settings'}">
            <span>Cai dat</span>
        </router-link>
      </a-menu-item>
    </a-menu>
</template>
<script>
import { UserOutlined, TagOutlined } from '@ant-design/icons-vue';
import { defineComponent } from 'vue';
import { storeToRefs } from 'pinia';
import { useMenu } from "../stores/use-menu.js";

export default defineComponent({
  components: {
    UserOutlined,
    TagOutlined
  },
  setup() {
    const store = useMenu();

    return {
      ...storeToRefs(store)
    };
  },
});
</script>
