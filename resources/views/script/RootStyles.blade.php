<style>
    :root {
        --primary: {{ $page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_rgb_back_01'] : '' }};
        --primary-light: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_01'] : '', 30) }};
        --primary-dark: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_01'] : '', -30) }};
        --primary-bw: {{luminosity($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_01'] : '')}};

        --secondary: {{ $page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_rgb_back_02'] : ''}};
        --secondary-light: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_02'] : '', 30) }};
        --secondary-dark: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_02'] : '', -20) }};
        --secondary-bw: {{ luminosity($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_02'] : '')}};

        --tertiary: {{ $page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_rgb_back_03'] : '' }};
        --tertiary-light: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_03'] : '', 30) }};
        --tertiary-dark: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_03'] : '', -30) }};
        --tertiary-bw: {{luminosity($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_03'] : '')}};

        --fourth: {{ $page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_rgb_back_04'] : '' }};
        --fourth-light: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_04'] : '', 30) }};
        --fourth-dark: {{ shadeColor($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_04'] : '', -30) }};
        --fourth-bw: {{luminosity($page['props']['siteConfig']['site_configuration_people'] ? $page['props']['siteConfig']['site_configuration_people'][0]['color_back_04'] : '')}};
    }
</style>
