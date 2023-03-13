<template>
    Day la trang quan ly users
</template>

<script>
import { useMenu } from "../../../stores/use-menu.js";

export default {
    setup() {
        useMenu().onSelectedKeys(["admin-users"]);
    }
}
</script>
