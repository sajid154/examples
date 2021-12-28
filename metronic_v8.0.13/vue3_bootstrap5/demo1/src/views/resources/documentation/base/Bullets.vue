<template>
  <!--begin::Card-->
  <div class="card">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>

      <Basic></Basic>

      <Colors></Colors>

      <DotStyle></DotStyle>

      <VarticalStyle></VarticalStyle>

      <Sizes></Sizes>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script lang="ts">
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/base/bullets/Overview.vue";
import Basic from "@/views/resources/documentation/base/bullets/Basic.vue";
import Colors from "@/views/resources/documentation/base/bullets/Colors.vue";
import DotStyle from "@/views/resources/documentation/base/bullets/DotStyle.vue";
import VarticalStyle from "@/views/resources/documentation/base/bullets/VarticalStyle.vue";
import Sizes from "@/views/resources/documentation/base/bullets/Sizes.vue";

export default defineComponent({
  name: "bullets",
  components: {
    Overview,
    Basic,
    Colors,
    DotStyle,
    VarticalStyle,
    Sizes
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("Bullets");
    });
  }
});
</script>
