$(() => {
    $('.current-year').each((i, el) => {
        const $el = $(el)
            , { launchYear = 2017, currentYear = new Date().getFullYear() } = $el.data()
        ;
        $el.html((launchYear === currentYear) ?
            currentYear :
            `${launchYear}&mdash;${currentYear}`);
    });
});
