<template>
  <div class="mb-10">
    <!--begin::Heading-->
    <h1 class="anchor fw-bolder mb-5">
      <a href="#upload"></a>
      Upload
    </h1>
    <!--end::Heading-->

    <!--begin::Block-->
    <div class="py-5">
      Upload files by clicking or drag-and-drop
    </div>
    <!--end::Block-->
  </div>
  <EUIClickToUploadFiles></EUIClickToUploadFiles>
  <EUIUserAvatarUpload></EUIUserAvatarUpload>
  <EUIPhotoWall></EUIPhotoWall>
  <EUICustomFileThumbnail></EUICustomFileThumbnail>
  <EUIFileListWithThumbnail></EUIFileListWithThumbnail>
  <EUIFileListControl></EUIFileListControl>
  <EUIDragToUpload></EUIDragToUpload>
  <EUIManualUpload></EUIManualUpload>
</template>

<script>
import { defineComponent } from "vue";
import { setCurrentPageTitle } from "@/core/helpers/breadcrumb";
import EUIClickToUploadFiles from "@/views/resources/documentation/element-ui/form/upload/ClickToUploadFiles.vue";
import EUIUserAvatarUpload from "@/views/resources/documentation/element-ui/form/upload/UserAvatarUpload.vue";
import EUIPhotoWall from "@/views/resources/documentation/element-ui/form/upload/PhotoWall.vue";
import EUICustomFileThumbnail from "@/views/resources/documentation/element-ui/form/upload/CustomFileThumbnail.vue";
import EUIFileListWithThumbnail from "@/views/resources/documentation/element-ui/form/upload/FileListWithThumbnail.vue";
import EUIFileListControl from "@/views/resources/documentation/element-ui/form/upload/FileListControl.vue";
import EUIDragToUpload from "@/views/resources/documentation/element-ui/form/upload/DragToUpload.vue";
import EUIManualUpload from "@/views/resources/documentation/element-ui/form/upload/ManualUpload.vue";

export default defineComponent({
  name: "upload",
  components: {
    EUIClickToUploadFiles,
    EUIUserAvatarUpload,
    EUIPhotoWall,
    EUICustomFileThumbnail,
    EUIFileListWithThumbnail,
    EUIFileListControl,
    EUIDragToUpload,
    EUIManualUpload
  },
  setup() {
    setCurrentPageTitle("Upload");
  }
});
</script>
