export type State = { classes: object };
import { Module, VuexModule, Mutation, Action } from "vuex-module-decorators";
import { Actions, Mutations } from "@/store/enums/StoreEnums.ts";

export interface StoreInfo {
  classes: object;
}

@Module
export default class BodyModule extends VuexModule implements StoreInfo {
  classes = {};

  /**
   * Get current page title
   * @returns string
   */
  get getClasses(): object {
    return position => {
      if (typeof position !== "undefined") {
        return this.classes[position];
      }
      return this.classes;
    };
  }

  @Mutation
  [Mutations.SET_CLASSNAME_BY_POSITION](payload) {
    const { position, className } = payload;
    if (!this.classes[position]) {
      this.classes[position] = [];
    }
    this.classes[position].push(className);
  }

  @Action
  [Actions.ADD_BODY_CLASSNAME](className) {
    document.body.classList.add(className);
  }

  @Action
  [Actions.REMOVE_BODY_CLASSNAME](className) {
    document.body.classList.remove(className);
  }

  @Action
  [Actions.ADD_BODY_ATTRIBUTE](payload) {
    const { qulifiedName, value } = payload;
    document.body.setAttribute(qulifiedName, value);
  }

  @Action
  [Actions.REMOVE_BODY_ATTRIBUTE](payload) {
    const { qulifiedName } = payload;
    document.body.removeAttribute(qulifiedName);
  }

  @Action
  [Actions.ADD_CLASSNAME](payload) {
    this.context.commit(Mutations.SET_CLASSNAME_BY_POSITION, payload);
  }
}
