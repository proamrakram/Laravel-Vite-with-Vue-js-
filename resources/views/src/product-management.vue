<template>
  <div id="app">
    <div class="preloader">
      <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
      </div>
    </div>

    <div id="main-wrapper">
      <header class="topbar">
        <navBar
          v-on:search="searchingData"
          v-bind:english="getLocal('English')"
          v-bind:arabic="getLocal('Arabic')"
          v-bind:acccountname="getLocal('Acccount Name')"
          v-bind:myprofile="getLocal('My Profile')"
          v-bind:mybalance="getLocal('My Balance')"
          v-bind:inbox="getLocal('Inbox')"
          v-bind:accountsetting="getLocal('Account Setting')"
          v-bind:logout="getLocal('Logout')"
          v-bind:viewprofile="getLocal('View Profile')"
        ></navBar>
      </header>

      <sideBar
        v-bind:english="getLocal('English')"
        v-bind:arabic="getLocal('Arabic')"
        v-bind:acccountname="getLocal('Acccount Name')"
        v-bind:myprofile="getLocal('My Profile')"
        v-bind:mybalance="getLocal('My Balance')"
        v-bind:inbox="getLocal('Inbox')"
        v-bind:accountsetting="getLocal('Account Setting')"
        v-bind:logout="getLocal('Logout')"
        v-bind:viewprofile="getLocal('View Profile')"
        v-bind:products="getLocal('Products')"
        v-bind:store="getLocal('Store')"
      ></sideBar>

      <div class="page-wrapper">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title">{{getLocal('Dashboard')}}</h4>
              <div class="d-flex align-items-center"></div>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">{{getLocal('Products Management')}}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{getLocal('Dashboard')}}</li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>

        <div class="container-fluid">
          <tableVue></tableVue>
        </div>

        <footerVue v-bind:footer="getLocal('All rights reserved to the programmer Amr Akram')"></footerVue>
      </div>
    </div>
  </div>
</template>


<script>
import SideBar from "../components/side-bar.vue";
import FooterVue from "../components/footer.vue";
import TableVue from "../components/table.vue";
import NavBar from "../components/nav-bar.vue";

import Lang from "lang.js";

const default_locale = window.default_language;
const fallback_locale = window.fallback_locale;
const messages = window.messages;
var trans;

export default {
  name: "product-management",
  components: {
    NavBar,
    SideBar,
    FooterVue,
    TableVue
  },

  data() {
    return {
      locale: "ar",
      fallback: "ar",
      translations: null,
      dataSearch: ""
    };
  },

  created() {
    trans = new Lang({ messages, default_locale, fallback_locale });
    console.log(trans, trans.locale);
    this.translations = trans.messages.json.ar;
    this.locale = trans.locale == "en" ? "en" : this.fallback;
  },

  methods: {
    getLocal(value) {
      if (this.locale == "ar") {
        for (var key in this.translations) {
          if (this.translations.hasOwnProperty(key)) {
            if (key == value) {
              return this.translations[key];
            }
          }
        }

        return value;
      }

      if (this.locale == "en") {
        for (var key in this.translations) {
          if (this.translations.hasOwnProperty(key)) {
            if (key == value) {
              return key;
            }
          }
        }

        return value;
      }
    }
  }
};
</script>
