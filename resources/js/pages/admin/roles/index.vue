<template>
    Day la trang quan ly roles
</template>

<script>
import { useMenu } from "../../../stores/use-menu.js";

export default {
    setup() {
        useMenu().onSelectedKeys(["admin-roles"]);
    }
}

</script>
