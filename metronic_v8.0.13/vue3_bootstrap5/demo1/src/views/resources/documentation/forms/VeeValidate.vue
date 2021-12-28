<template>
  <!--begin::Card-->
  <div class="card card-custom">
    <!--begin::Card Body-->
    <div class="card-body p-10 p-lg-15">
      <Overview></Overview>
      <Example1></Example1>
      <Example2></Example2>
      <Example3></Example3>
      <Example4></Example4>
    </div>
    <!--end::Card Body-->
  </div>
  <!--end::Card-->
</template>

<script>
import { defineComponent, onMounted } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import Overview from "@/views/resources/documentation/forms/vee-validate/Overview";
import Example1 from "@/views/resources/documentation/forms/vee-validate/Example1";
import Example2 from "@/views/resources/documentation/forms/vee-validate/Example2";
import Example3 from "@/views/resources/documentation/forms/vee-validate/Example3";
import Example4 from "@/views/resources/documentation/forms/vee-validate/Example4";

export default defineComponent({
  name: "vee-validate",
  components: {
    Overview,
    Example1,
    Example2,
    Example3,
    Example4
  },
  setup() {
    onMounted(() => {
      setCurrentPageTitle("VeeValidate");
    });
  }
});
</script>
