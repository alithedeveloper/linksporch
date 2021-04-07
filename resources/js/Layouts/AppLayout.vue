<template>
    <div>
        <jet-banner />
        <notification/>
        <div class="min-h-screen bg-gray-100">


            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <off-canvas-mobile-menu />
            <div class="flex min-h-screen flex">
                <SideBarNav />
                <!-- Page Content -->
                <main class="flex-1 md:ml-20">
                    <slot></slot>
                </main>
            </div>

        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import OffCanvasMobileMenu from "@/Partials/OffCanvasMobileMenu"
    import SideBarNav from "@/Partials/SideBarNav"
    import Notification from "../Components/Notification";

    export default {
        components: {
            Notification,
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            OffCanvasMobileMenu,
            SideBarNav,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },

            logout() {
                this.$inertia.post(route('logout'));
            },
        }
    }
</script>
