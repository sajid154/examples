import objectPath from "object-path";
import merge from "deepmerge";
import layoutConfig from "@/core/config/DefaultLayoutConfig.ts";
import { Mutations } from "@/store/enums/StoreEnums";
import { Mutation, Module, VuexModule } from "vuex-module-decorators";

interface StoreInfo {
  config: object;
  initial: object;
}

@Module
export default class ConfigModule extends VuexModule implements StoreInfo {
  config: object = layoutConfig;
  initial: object = layoutConfig;

  /**
   * Get config from layout config
   * @returns {function(path, defaultValue): *}
   */
  get layoutConfig() {
    return (path, defaultValue) => {
      return objectPath.get(this.config, path, defaultValue);
    };
  }

  @Mutation
  [Mutations.SET_LAYOUT_CONFIG](payload: object): void {
    this.config = payload;
  }

  @Mutation
  [Mutations.RESET_LAYOUT_CONFIG]() {
    this.config = Object.assign({}, this.initial);
  }

  @Mutation
  [Mutations.OVERRIDE_LAYOUT_CONFIG](): void {
    this.config = this.initial = Object.assign(
      {},
      this.initial,
      JSON.parse(window.localStorage.getItem("config") || "{}")
    );
  }

  @Mutation
  [Mutations.OVERRIDE_PAGE_LAYOUT_CONFIG](payload: object): void {
    this.config = merge(this.config, payload);
  }
}
