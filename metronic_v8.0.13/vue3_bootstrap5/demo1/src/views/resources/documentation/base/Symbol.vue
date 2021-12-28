<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <Avatar></Avatar>

      <AvatarBackground></AvatarBackground>

      <AvatarRatio></AvatarRatio>

      <Label></Label>

      <Badge></Badge>

      <Styles></Styles>

      <Sizes></Sizes>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/base/symbol/Overview.vue";
import Avatar from "@/views/resources/documentation/base/symbol/Avatar.vue";
import AvatarBackground from "@/views/resources/documentation/base/symbol/AvatarBackground.vue";
import AvatarRatio from "@/views/resources/documentation/base/symbol/AvatarRatio.vue";
import Label from "@/views/resources/documentation/base/symbol/Label.vue";
import Badge from "@/views/resources/documentation/base/symbol/Badge.vue";
import Styles from "@/views/resources/documentation/base/symbol/Styles.vue";
import Sizes from "@/views/resources/documentation/base/symbol/Sizes.vue";

export default defineComponent({
  name: "symbol",
  components: {
    Overview,
    Avatar,
    AvatarBackground,
    AvatarRatio,
    Label,
    Badge,
    Styles,
    Sizes
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Symbol");
    });
  }
});
</script>
