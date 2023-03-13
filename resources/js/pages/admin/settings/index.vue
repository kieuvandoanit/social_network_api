<template>
    Day la trang quan ly Settings
</template>

<script>
import { useMenu } from '../../../stores/use-menu';

export default {
    setup() {
        useMenu().onSelectedKeys(["admin-settings"]);
    }
}
</script>
