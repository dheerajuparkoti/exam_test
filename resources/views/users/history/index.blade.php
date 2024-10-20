@extends('layouts.master')
<link rel='stylesheet' type='text/css' media='screen' href="{{ asset('assets/css/users') }}/history.css">
@section('content')


<section>
    <!-- Centered Charts 1, 2, 3, and 4, each on a separate row -->

    <div class="chart-row">
        <!-- Fourth Chart -->
        <div class="chart-container">
            <canvas id="chart4"></canvas>
        </div>
    </div>
    
    <div class="chart-row">
   
        <!-- First Chart -->
        <div class="chart-container">
            <canvas id="chart1"></canvas>
        </div>
    </div>
    <div class="chart-row">
        <!-- Second Chart -->
        <div class="chart-container">
            <canvas id="chart2"></canvas>
        </div>
    </div>
    <div class="chart-row">
        <!-- Third Chart -->
        <div class="chart-container">
            <canvas id="chart3"></canvas>
        </div>
    </div>
   

<!-- Row for two charts per row (Pie Charts) -->
<div class="charts-row">
    <!-- Chart 5: Category Distribution Pie Chart -->
    <div class="pie-chart-container">
        <canvas id="chart5"></canvas>
    </div>
    
    <!-- Chart 6: Level Distribution Pie Chart -->
    <div class="pie-chart-container">
        <canvas id="chart6"></canvas>
    </div>
</div>

<!-- Row for two charts per row (Pie Charts) -->
<div class="charts-row">
    <!-- Chart 7: Faculty Distribution Pie Chart -->
    <div class="pie-chart-container">
        <canvas id="chart7"></canvas>
    </div>
    
    <!-- Chart 8: SubFaculty Distribution Pie Chart -->
    <div class="pie-chart-container">
        <canvas id="chart8"></canvas>
    </div>
</div>

</section>

    


    <!-- Add Chart.js CDN here -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // First Chart
            const ctx1 = document.getElementById('chart1').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [
                        {
                            label: 'Full Marks',
                            data: @json($fullMarks),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            barThickness: 50
                        },
                        {
                            label: 'Pass Marks',
                            data: @json($passMarks),
                            backgroundColor: 'rgba(255, 206, 86, 0.6)',
                            borderColor: 'rgba(255, 206, 86, 1)',
                            borderWidth: 1,
                            barThickness: 50
                        },
                        {
                            label: 'Obtained Marks',
                            data: @json($obtainedMarks),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            barThickness: 50
                        }
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Marks vs. Question Models',
                            font: {
                                size: 20
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Question Models'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Marks'
                            }
                        }
                    },
                    responsive: true
                }
            });

            // Second Chart
            const ctx2 = document.getElementById('chart2').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Total Questions',
                            data: @json($totalQuestionsData),
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            barThickness: 30
                        },
                        {
                            label: 'Answered Questions',
                            data: @json($answeredQuestionsData),
                            backgroundColor: 'rgba(153, 102, 255, 0.6)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 1,
                            barThickness: 30
                        },
                        {
                            label: 'Skipped Questions',
                            data: @json($skippedQuestionsData),
                            backgroundColor: 'rgba(255, 159, 64, 0.6)',
                            borderColor: 'rgba(255, 159, 64, 1)',
                            borderWidth: 1,
                            barThickness: 30
                        },
                        {
                            label: 'Correct Answers',
                            data: @json($correctAnswersData),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            barThickness: 30
                        },
                        {
                            label: 'Mistake Answers',
                            data: @json($mistakeAnswersData),
                            backgroundColor: 'rgba(255, 205, 86, 0.6)',
                            borderColor: 'rgba(255, 205, 86, 1)',
                            borderWidth: 1,
                            barThickness: 30
                        }
                    ]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Question Number vs. Models',
                            font: {
                                size: 20
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            stacked: false,
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Question Models'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Questions'
                            }
                        }
                    },
                    responsive: true
                }
            });

 // Third Chart (Number of Models vs. Date in Month)
 const ctx3 = document.getElementById('chart3').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Number of Models',
                    data: @json($modelCounts),
                    backgroundColor: 'rgba(75, 192, 192, 0.6)', // Light green color
                    borderColor: 'rgba(75, 192, 192, 1)', // Darker green border
                    borderWidth: 1,
                    barThickness: 40
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Practiced No. of Models Vs. Date in Month',
                        font: {
                            size: 20
                        },
                        padding: {
                            top: 10,
                            bottom: 30
                        }
                    },
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y;
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Date (Month)'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Models'
                        }
                    }
                },
                responsive: true
            }
        });

            // Fourth Chart (Weekly Progress Report)
            const ctx4 = document.getElementById('chart4').getContext('2d');
            new Chart(ctx4, {
                type: 'line',
                data: {
                    labels: @json($weeks),
                    datasets: [{
                        label: 'Highest Obtained Marks per Week',
                        data: @json($maxObtainedMarks),
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 2,
                        fill: true
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Weekly Progress Report',
                            font: {
                                size: 20
                            },
                            padding: {
                                top: 10,
                                bottom: 30
                            }
                        },
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y;
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Weeks'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Highest Obtained Marks'
                            }
                        }
                    },
                    responsive: true
                }
            });


            // chart -5 
// Chart 5: Category Distribution Pie Chart
const ctx5 = document.getElementById('chart5').getContext('2d');
new Chart(ctx5, {
    type: 'pie',
    data: {
        labels: @json($finalCategoryNames),
        datasets: [{
            label: 'Category Distribution',
            data: @json($finalCategoryCounts),
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // Red
                'rgba(54, 162, 235, 0.6)', // Blue
                'rgba(255, 206, 86, 0.6)', // Yellow
                'rgba(75, 192, 192, 0.6)', // Green
                'rgba(153, 102, 255, 0.6)', // Purple
                'rgba(255, 159, 64, 0.6)'  // Orange
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Red
                'rgba(54, 162, 235, 1)', // Blue
                'rgba(255, 206, 86, 1)', // Yellow
                'rgba(75, 192, 192, 1)', // Green
                'rgba(153, 102, 255, 1)', // Purple
                'rgba(255, 159, 64, 1)'  // Orange
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed > 0) {
                            label += context.parsed + '%';
                        } else {
                            label += '0%';
                        }
                        return label;
                    }
                }
            },
            title: {
                display: true,
                text: 'Category Distribution',
                font: {
                    size: 20
                },
                padding: {
                    top: 10,
                    bottom: 20
                },
                align: 'center'
            }
        }
    }
});

            // chart -6
// Chart 6: Level Distribution Pie Chart
const ctx6 = document.getElementById('chart6').getContext('2d');
new Chart(ctx6, {
    type: 'pie',
    data: {
        labels: @json($finalLevelNames),
        datasets: [{
            label: 'Level Distribution',
            data: @json($finalLevelCounts),
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // Red
                'rgba(54, 162, 235, 0.6)', // Blue
                'rgba(255, 206, 86, 0.6)', // Yellow
                'rgba(75, 192, 192, 0.6)', // Green
                'rgba(153, 102, 255, 0.6)', // Purple
                'rgba(255, 159, 64, 0.6)'  // Orange
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Red
                'rgba(54, 162, 235, 1)', // Blue
                'rgba(255, 206, 86, 1)', // Yellow
                'rgba(75, 192, 192, 1)', // Green
                'rgba(153, 102, 255, 1)', // Purple
                'rgba(255, 159, 64, 1)'  // Orange
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed > 0) {
                            label += context.parsed + '%';
                        } else {
                            label += '0%';
                        }
                        return label;
                    }
                }
            },
            title: {
                display: true,
                text: 'Level Distribution',
                font: {
                    size: 20
                },
                padding: {
                    top: 10,
                    bottom: 20
                },
                align: 'center'
            }
        }
    }
});

            // chart -7
// Chart 7: Faculty Distribution Pie Chart
const ctx7 = document.getElementById('chart7').getContext('2d');
new Chart(ctx7, {
    type: 'pie',
    data: {
        labels: @json($finalFacultyNames),
        datasets: [{
            label: 'Faculty Distribution',
            data: @json($finalFacultyCounts),
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // Red
                'rgba(54, 162, 235, 0.6)', // Blue
                'rgba(255, 206, 86, 0.6)', // Yellow
                'rgba(75, 192, 192, 0.6)', // Green
                'rgba(153, 102, 255, 0.6)', // Purple
                'rgba(255, 159, 64, 0.6)'  // Orange
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Red
                'rgba(54, 162, 235, 1)', // Blue
                'rgba(255, 206, 86, 1)', // Yellow
                'rgba(75, 192, 192, 1)', // Green
                'rgba(153, 102, 255, 1)', // Purple
                'rgba(255, 159, 64, 1)'  // Orange
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed > 0) {
                            label += context.parsed + '%';
                        } else {
                            label += '0%';
                        }
                        return label;
                    }
                }
            },
            title: {
                display: true,
                text: 'Faculty Distribution',
                font: {
                    size: 20
                },
                padding: {
                    top: 10,
                    bottom: 20
                },
                align: 'center'
            }
        }
    }
});


      // chart -8
// Chart 8: Faculty Distribution Pie Chart
const ctx8 = document.getElementById('chart8').getContext('2d');
new Chart(ctx8, {
    type: 'pie',
    data: {
        labels: @json($finalSubFacultyNames),
        datasets: [{
            label: 'Sub-Faculty Distribution',
            data: @json($finalSubFacultyCounts),
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', // Red
                'rgba(54, 162, 235, 0.6)', // Blue
                'rgba(255, 206, 86, 0.6)', // Yellow
                'rgba(75, 192, 192, 0.6)', // Green
                'rgba(153, 102, 255, 0.6)', // Purple
                'rgba(255, 159, 64, 0.6)'  // Orange
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)', // Red
                'rgba(54, 162, 235, 1)', // Blue
                'rgba(255, 206, 86, 1)', // Yellow
                'rgba(75, 192, 192, 1)', // Green
                'rgba(153, 102, 255, 1)', // Purple
                'rgba(255, 159, 64, 1)'  // Orange
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.label || '';
                        if (label) {
                            label += ': ';
                        }
                        if (context.parsed > 0) {
                            label += context.parsed + '%';
                        } else {
                            label += '0%';
                        }
                        return label;
                    }
                }
            },
            title: {
                display: true,
                text: 'Sub-Faculty Distribution',
                font: {
                    size: 20
                },
                padding: {
                    top: 10,
                    bottom: 20
                },
                align: 'center'
            }
        }
    }
});
        });

    </script>
@endsection
