<template>
  <aside class="left-sidebar">
    <div class="scroll-sidebar bg-dark">
      <nav class="sidebar-nav">
        <ul id="sidebarnav">
          <li>
            <div class="user-profile dropdown m-t-20 bg-dark">
              <div class="user-pic">
                <img src="assets/images/users/me.jpg" alt="users" class="rounded-circle img-fluid" />
              </div>
              <div class="user-content hide-menu m-t-10">
                <h5 class="m-b-10 user-name font-medium">{{acccountname}}</h5>
                <a
                  href="javascript:void(0)"
                  class="btn btn-circle btn-sm m-r-5"
                  id="Userdd"
                  role="button"
                  data-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i class="ti-settings"></i>
                </a>
                <a href="javascript:void(0)" title="Logout" class="btn btn-circle btn-sm">
                  <i class="ti-power-off"></i>
                </a>
                <div class="dropdown-menu animated flipInY" aria-labelledby="Userdd">
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="ti-user m-r-5 m-l-5"></i>
                    {{myprofile}}
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="ti-wallet m-r-5 m-l-5"></i>
                    {{mybalance}}
                  </a>
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="ti-email m-r-5 m-l-5"></i>
                    {{inbox}}
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="ti-settings m-r-5 m-l-5"></i>
                    {{accountsetting}}
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)">
                    <i class="fa fa-power-off m-r-5 m-l-5"></i>
                    {{logout}}
                  </a>
                </div>
              </div>
            </div>
          </li>

          <li class="sidebar-item">
            <a
              class="sidebar-link has-arrow waves-effect waves-dark"
              href="javascript:void(0)
                                            "
              aria-expanded="false"
            >
              <i class="icon-Shopping-Bag"></i>
              <span class="hide-menu">{{store}}</span>
            </a>

            <ul aria-expanded="false" class="collapse first-level">
              <li class="sidebar-item">
                <a href="/" class="sidebar-link">
                  <i class="mdi mdi-cards-variant"></i>
                  <span class="hide-menu">{{products}}</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
</template>


<script>
export default {
  name: "side-bar",
  props: [
    "english",
    "arabic",
    "acccountname",
    "myprofile",
    "mybalance",
    "inbox",
    "accountsetting",
    "logout",
    "viewprofile",
    "products",
    "store"
  ],
  data() {
    return {
      image: "./me.jpg",
      test: "Hello Aimadl"
    };
  }
};
</script>
