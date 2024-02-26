(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, {offset: '80%'});


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav : false
    });


    // Chart Global Color
    Chart.defaults.color = "#6C7293";
    Chart.defaults.borderColor = "#000000";




    // Single Line Chart
    var ctx3 = $("#line-chart").get(0).getContext("2d");

    var usernames = [];
    var totalComments = [];

    // Preencher os arrays com os dados de usersWithMostComments
    usersWithMostComments.forEach(function(user) {
        usernames.push(user.username);
        totalComments.push(user.total_comments);
    });

    var myChart3 = new Chart(ctx3, {
        type: "line",
        data: {
            labels: usernames, // Usar os usernames como labels
            datasets: [{
                label: "Number of Comments", // Nome do dataset
                fill: false,
                backgroundColor: "rgba(235, 22, 22, .7)",
                data: totalComments // Usar a quantidade de comentários como dados
            }]
        },
        options: {
            responsive: true
        }
    });


    // Single Bar Chart Genre 
    var ctx4 = $("#bar-chart").get(0).getContext("2d");
    var myChart4 = new Chart(ctx4, {
        type: "bar",
        data: {
            labels: Object.keys(totalMoviesByGenre), // Obtém os nomes dos gêneros
            datasets: [{
                label: "Genre",
                backgroundColor: [
                    "rgba(235, 22, 22, .7)",
                    "rgba(235, 22, 22, .6)",
                    "rgba(235, 22, 22, .5)",
                    "rgba(235, 22, 22, .4)",
                    "rgba(235, 22, 22, .3)"
                ],
                data: Object.values(totalMoviesByGenre) // Obtém o número de filmes por gênero
            }]
        },
        options: {
            responsive: true
        }
    });


    // Pie Chart Filmes com mais likes
    var ctx5 = $("#pie-chart").get(0).getContext("2d");
    var myChart5 = new Chart(ctx5, {
        type: "pie",
        data: {
            labels: [], // Vai preencher com os nomes dos filmes com mais likes
            datasets: [{
                backgroundColor: [
                    "rgba(235, 22, 22, .7)",
                    "rgba(235, 22, 22, .6)",
                    "rgba(235, 22, 22, .5)",
                    "rgba(235, 22, 22, .4)",
                    "rgba(235, 22, 22, .3)"
                ],
                data: [] // Vai preencher com a quantidade de likes de cada filme
            }]
        },
        options: {
            responsive: true
        }
    });

    // Preenche os dados do gráfico com as informações das multimedias com mais likes
    var labels = [];
    var data = [];
    multimedia5likes.forEach(function(multimedia) {
        labels.push(multimedia.title);
        data.push(multimedia.likes_count);
    });

    // Atualiza os dados do gráfico com as informações das multimedias
    myChart5.data.labels = labels;
    myChart5.data.datasets[0].data = data;

    // Atualiza o gráfico
    myChart5.update();



    // Doughnut Chart
    var ctx6 = $("#doughnut-chart").get(0).getContext("2d");
    var myChart6 = new Chart(ctx6, {
        type: "doughnut",
        data: {
            labels: multimedia5Votes.map(media => media.title), // Nomes dos filmes
            datasets: [{
                backgroundColor: [
                    "rgba(235, 22, 22, .7)",
                    "rgba(235, 22, 22, .6)",
                    "rgba(235, 22, 22, .5)",
                    "rgba(235, 22, 22, .4)",
                    "rgba(235, 22, 22, .3)"
                ], // Cores de fundo
                data: multimedia5Votes.map(media => media.imdb_votes) // Número de votos
            }]
        },
        options: {
            responsive: true
        }
    });

    
})(jQuery);

