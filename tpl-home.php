<?php
/**
 * Template Name: Home Page
 */

get_header();

if ( astra_page_layout() == 'left-sidebar' ){
    get_sidebar();
}

$tpl_dir_uri = get_stylesheet_directory_uri();
$banner = get_field('banner');
$counters = get_field('counters');
$info = get_field('info');
$charts = get_field('charts');
$iq_countries = get_field('iq_countries');
?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-gradient-bg"></script>
    <style>
        /* Add styling for bold numbers */
        .bold-number {
            font-weight: bold;
        }
        /* Modern Famous People Section Styles */
        .famous-people-section {
            padding: 80px 0;
            background: linear-gradient(180deg, rgba(var(--ast-global-color-0-rgb), 0.03) 0%, rgba(var(--ast-global-color-0-rgb), 0) 100%);
        }
        
        .famous-people-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 20px 0;
        }
        
        .famous-person-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(var(--ast-global-color-0-rgb), 0.1);
        }
        
        .famous-person-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
        }
        
        .famous-person-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(var(--ast-global-color-0-rgb), 0.05) 0%, rgba(var(--ast-global-color-0-rgb), 0) 100%);
            z-index: 0;
        }
        
        .person-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        
        .person-image-wrapper {
            position: relative;
            margin-right: 15px;
        }
        
        .famous-person-image {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .verified-badge {
            position: absolute;
            bottom: -5px;
            right: -5px;
            background: var(--ast-global-color-0);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            border: 2px solid white;
        }
        
        .person-info {
            flex-grow: 1;
        }
        
        .person-name {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 5px;
            color: var(--ast-global-color-3);
        }
        
        .iq-score {
            display: inline-flex;
            align-items: center;
            color: var(--ast-global-color-0);
            padding: 5px 12px;
            border-radius: 30px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .iq-score svg {
            margin-right: 5px;
            width: 16px;
            height: 16px;
        }
        
        .person-achievements {
            position: relative;
            z-index: 1;
            font-size: 0.9rem;
            color: var(--ast-global-color-3);
            opacity: 0.8;
            margin: 0;
        }

        @media (max-width: 768px) {
            .famous-people-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
            
            .famous-person-card {
                padding: 20px;
            }
            
            .famous-person-image {
                width: 60px;
                height: 60px;
            }
        }
        .iq-deviation-section {
        padding: 60px 0;
       
    }

    .deviation-header {
        text-align: center;
        max-width: 800px;
        margin: 0 auto 40px;
    }

    .deviation-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .deviation-description {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.6;
    }

    .graph-container {
        margin: 40px auto;
        text-align: center;
        max-width: 900px;
    }

    .graph-placeholder {
        max-width: 100%;
        height: auto;
        border-radius: 12px;

    }

    .stanford-title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        margin: 50px 0 30px;
        color: #333;
    }

    .iq-categories-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 30px;
    }

    .iq-category-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .iq-category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .category-score {
        font-size: 1.8rem;
        font-weight: bold;
        color: var(--ast-global-color-0);
        margin-bottom: 10px;
    }

    .category-label {
        font-size: 1.1rem;
        color: #333;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .category-description {
        font-size: 0.95rem;
        color: #666;
        margin: 0;
    }

    @media (max-width: 991px) {
        .iq-categories-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .deviation-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 576px) {
        .iq-categories-grid {
            grid-template-columns: 1fr;
        }
    }

    .why-iq-test-section {
        padding: 60px 0;
       
    }

    .section-header {
        text-align: center;
        max-width: 900px;
        margin: 0 auto 50px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }

    .section-description {
        font-size: 1.1rem;
        color: #666;
        line-height: 1.6;
    }

    .benefits-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .benefit-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .benefit-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }

    .benefit-icon {
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--ast-global-color-0);
        border-radius: 50%;
    }

    .benefit-icon svg {
        width: 30px;
        height: 30px;
        color: #fff;
    }

    .benefit-title {
        font-size: 1.3rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
    }

    .benefit-description {
        font-size: 1rem;
        color: #666;
        line-height: 1.5;
    }

    .user-info {
        text-align: center;
        margin-bottom: 40px;
    }

    .user-info-item {
        display: inline-block;
        padding: 10px 20px;
        background: #f8f9fa;
        border-radius: 8px;
        margin: 0 10px;
        font-size: 0.9rem;
        color: #666;
    }

    .user-info-value {
        font-weight: 600;
        color: #333;
    }

    @media (max-width: 991px) {
        .benefits-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }

        .benefits-grid {
            grid-template-columns: 1fr;
        }

        .benefit-card {
            padding: 25px;
        }

        .user-info-item {
            display: block;
            margin: 10px auto;
            max-width: 300px;
        }
    }
    /* Countries */
    .iq-container {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            background-color: transparent;
            color: #263238;
        }
        
        .iq-heading {
            text-align: center;
            font-size: 38px;
            margin-bottom: 50px;
            font-weight: 700;
            letter-spacing: -0.5px;
            background: linear-gradient(to right, #2c3e50, #3498db);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        
        .iq-country-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 25px 40px;
            border-radius: 16px;
            margin-bottom: 40px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: transform 0.3s ease;
        }
        
        .iq-country-main:hover {
            transform: translateY(-5px);
        }
        
        .iq-country-info {
            display: flex;
            align-items: center;
        }
        
        .iq-flag-main {
            width: 70px;
            height: 45px;
            margin-right: 20px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .iq-country-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(to right, #2c3e50, #3498db);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        
        .iq-country-subtitle {
            font-size: 15px;
            color: #607D8B;
            margin: 5px 0 0 0;
            font-weight: 400;
        }
        
        .iq-score-main {
            font-size: 48px;
            font-weight: 800;
            color: #3498db;
            text-shadow: 0 2px 4px rgba(52, 152, 219, 0.1);
            position: relative;
        }
        
        .iq-score-main::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 100%;
            height: 4px;
            color: var(--ast-global-color-0);
            border-radius: 2px;
        }
        
        .iq-country-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        
        .iq-country-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            padding: 18px 22px;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .iq-country-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            background: rgba(255, 255, 255, 0.85);
        }
        
        .iq-flag-wrap {
            display: flex;
            align-items: center;
        }
        
        .iq-flag {
            width: 36px;
            height: 24px;
            margin-right: 14px;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        
        .iq-country-name {
            font-weight: 500;
            color: #37474F;
            font-size: 16px;
        }
        
        .iq-score {
            font-weight: 700;
            color: var(--ast-global-color-0);
            font-size: 22px;
            position: relative;
            padding-bottom: 4px;
        }
        
        .iq-score::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, #3498db, #2ecc71);
            border-radius: 1px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .iq-country-card:hover .iq-score::after {
            opacity: 1;
        }
        
        @media (max-width: 900px) {
            .iq-country-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 600px) {
            .iq-country-grid {
                grid-template-columns: 1fr;
            }
            
            .iq-country-main {
                flex-direction: column;
                text-align: center;
                padding: 25px;
            }
            
            .iq-country-info {
                margin-bottom: 20px;
                justify-content: center;
                flex-direction: column;
            }
            
            .iq-flag-main {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .iq-heading {
                font-size: 32px;
            }
        }
        /* Section - 6 */
        .statistics-section {
    padding: 80px 0;
    background: linear-gradient(180deg, rgba(248, 249, 250, 0.7) 0%, rgba(255, 255, 255, 0.5) 100%);
    position: relative;
    overflow: hidden;
}

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 50px;
    }

    .graph-container {
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        transition: transform 0.3s ease;
        background: transparent; /* Remove background */
        
    }

    .graph-container:hover {
        transform: translateY(-5px);
    }

    .graph-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .current-info {
        text-align: center;
        margin-bottom: 40px;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        display: inline-block;
        margin-left: 50%;
        transform: translateX(-50%);
    }

    .info-line {
        color: #666;
        font-size: 0.95rem;
        margin: 5px 0;
    }

    .info-value {
        font-weight: 500;
        color: #333;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
        
        .graph-container {
            padding: 20px;
        }
    }

    .statistics-section {
        padding: 60px 0;
        
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 50px;
    }

    .graph-container {
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        transition: transform 0.3s ease;
        background: transparent;
        box-shadow: none;
    }

    .graph-container:hover {
        transform: translateY(-5px);
    }

    .graph-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .current-info {
        text-align: center;
        margin-bottom: 40px;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        display: inline-block;
        margin-left: 50%;
        transform: translateX(-50%);
    }

    .info-line {
        color: #666;
        font-size: 0.95rem;
        margin: 5px 0;
    }

    .info-value {
        font-weight: 500;
        color: #333;
    }

    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem;
        }
        
        .graph-container {
            padding: 20px;
        }
    }
    .statistics-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.graph-row {
    margin-bottom: 40px;
}

.graph-row.two-columns {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
    max-width: 100%; /* Changed from 1100px to 100% to use full width */
    margin: 0 auto;
}

.graph-row.center-graph .graph-container {
    max-width: 500px;
    margin: 0 auto;
}

.graph-container {
    border-radius: 15px;
    padding: 35px; /* Increased padding for better visual appearance */
    transition: transform 0.3s ease;
    background: transparent;
    box-shadow: none;
    min-height: 350px; /* Added minimum height for consistent size */
}

.graph-container:hover {
    transform: translateY(-5px);
}

.graph-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

/* Add this to make chart canvases bigger */
canvas {
    max-height: 350px !important;
}

@media (max-width: 768px) {
    .graph-row.two-columns {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .graph-row.center-graph .graph-container {
        max-width: 100%;
    }
    
    .graph-container {
        padding: 20px;
        min-height: 300px;
    }
}

.statistics-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    z-index: -1;
}

.statistics-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-heading {
    text-align: center;
    margin-bottom: 50px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #333;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #2c3e50, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

.chart-card {
    border-radius: 16px;
    margin-bottom: 30px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.8);
    overflow: hidden;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.chart-content {
    padding: 30px;
}

.chart-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 25px;
    text-align: center;
    position: relative;
}

.chart-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: linear-gradient(to right, #3498db, #2ecc71);
    border-radius: 3px;
}

.chart-wrapper {
    position: relative;
    height: 300px;
    margin: 0 auto;
}

.charts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.featured-chart {
    max-width: 500px;
    margin: 0 auto 40px;
}

.wide-chart {
    margin-top: 30px;
}

.chart-legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
}

.legend-label {
    font-size: 0.9rem;
    color: #555;
}

@media (max-width: 768px) {
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-wrapper {
        height: 250px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .chart-title {
        font-size: 1.2rem;
    }
    
    .chart-content {
        padding: 20px;
    }
}

/* World map */
.container {
  max-width: 1400px;
  margin: 0 auto;
  position: relative;
}

h1 {
  text-align: center;
  margin-bottom: 2rem;
  font-weight: 500;
  letter-spacing: 1px;
}

h1 span {
  color: #6bb5ff;
  font-weight: 600;
}

.map-container {
    background: linear-gradient(135deg, #1a1f35 0%, #121420 100%);
  position: relative;
  height: calc(100vh - 150px);
  min-height: 500px;
  box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
  border-radius: 15px;
  overflow: hidden;
  background-color: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(5px);
  border: 1px solid rgba(255, 255, 255, 0.05);
}

#world-map {
  width: 100%;
  height: 100%;
}

.map-dot {
  position: absolute;
  border-radius: 50%;
  transform: translate(-50%, -50%);
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 0 15px rgba(107, 181, 255, 0.8);
  z-index: 10;
}

.map-dot.low {
  width: 12px;
  height: 12px;
  background-color: #ff7272;
}

.map-dot.medium {
  width: 12px;
  height: 12px;
  background-color: #ffca6c;
}

.map-dot.high {
  width: 12px;
  height: 12px;
  background-color: #65d6ad;
}

.map-dot:hover {
  transform: translate(-50%, -50%) scale(1.5);
  box-shadow: 0 0 20px rgba(107, 181, 255, 1);
}

.stats-popup {
  position: absolute;
  display: none;
  width: 300px;
  background: rgba(36, 47, 73, 0.95);
  backdrop-filter: blur(10px);
  border-radius: 10px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
  z-index: 100;
  border: 1px solid rgba(107, 181, 255, 0.3);
  overflow: hidden;
  transition: all 0.3s ease;
}

.stats-header {
  padding: 15px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  background-color: rgba(107, 181, 255, 0.1);
}

.stats-header h3 {
  color: #ffffff;
  font-weight: 500;
}

.close-btn {
  font-size: 20px;
  cursor: pointer;
  color: rgba(255, 255, 255, 0.6);
  transition: color 0.2s;
}

.close-btn:hover {
  color: #ffffff;
}

.stats-content {
  padding: 15px;
}

.stat-item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 10px;
  font-size: 14px;
}

.stat-label {
  color: rgba(255, 255, 255, 0.7);
}

.stat-value {
  font-weight: 600;
  color: #6bb5ff;
}

.legend {
  position: absolute;
  bottom: 20px;
  right: 20px;
  background: rgba(26, 31, 53, 0.8);
  backdrop-filter: blur(5px);
  padding: 10px 15px;
  border-radius: 8px;
  display: flex;
  flex-direction: column;
  gap: 8px;
  border: 1px solid rgba(255, 255, 255, 0.05);
}

.legend-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.legend-item p {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.8);
}

.dot {
  border-radius: 50%;
  display: inline-block;
  width: 12px;
  height: 12px;
}

.dot.low {
  background-color: #ff7272;
}

.dot.medium {
  background-color: #ffca6c;
}

.dot.high {
  background-color: #65d6ad;
}

.chart-container {
  margin-top: 15px;
  height: 150px;
}

/* Map styling */
.country {
  fill: rgba(255, 255, 255, 0.05);
  stroke: rgba(107, 181, 255, 0.3);
  stroke-width: 0.5px;
  transition: fill 0.3s ease;
}

.country:hover {
  fill: rgba(107, 181, 255, 0.1);
}

@media (max-width: 768px) {
  .map-container {
    height: calc(100vh - 100px);
  }

  .stats-popup {
    width: 260px;
  }
}

.statistics-section {
    padding: 80px 0;
    background: linear-gradient(180deg, rgba(248, 249, 250, 0.7) 0%, rgba(255, 255, 255, 0.5) 100%);
    position: relative;
    overflow: hidden;
}

.statistics-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0H2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    z-index: -1;
}

.statistics-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.section-heading {
    text-align: center;
    margin-bottom: 50px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #333;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #2c3e50, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

.chart-card {
    border-radius: 16px;
    margin-bottom: 30px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.8);
    overflow: hidden;
}

.chart-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.chart-content {
    padding: 30px;
}

.chart-title {
    font-size: 1.3rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 25px;
    text-align: center;
    position: relative;
}

.chart-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 50px;
    height: 3px;
    background: linear-gradient(to right, #3498db, #2ecc71);
    border-radius: 3px;
}

.chart-wrapper {
    position: relative;
    height: 300px;
    margin: 0 auto;
}

.charts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.featured-chart {
    max-width: 500px;
    margin: 0 auto 40px;
}

.wide-chart {
    margin-top: 30px;
}

.chart-legend {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 20px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    display: inline-block;
}

.legend-label {
    font-size: 0.9rem;
    color: #555;
}

@media (max-width: 768px) {
    .charts-grid {
        grid-template-columns: 1fr;
    }
    
    .chart-wrapper {
        height: 250px;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .chart-title {
        font-size: 1.2rem;
    }
    
    .chart-content {
        padding: 20px;
    }
}

.home-banner-title {
    text-align: left !important;
}
/* Facts */

.facts_section_container {
        text-align: center;
        width: 100%;
        
      }
      .facts_section_heading {
        font-size: 32px;
        font-weight: 600;
        color: #1f2937;
      }
      .facts_section_subheading {
        font-size: 24px;
        font-weight: bold;
        color: #1f2937;
        margin-top: 15px;
      }
      .facts_section_subheading span {
        color: #2563eb;
      }
      .facts_section_description {
        color: #4b5563;
        margin-top: 10px;
      }
      .facts_section_grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 30px;
      }
      .facts_section_card {
        padding: 30px 20px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }
      .facts_section_card_icon {
        font-size: 40px;
        margin-bottom: 10px;
      }
      .facts_section_card_title {
        font-weight: bold;
        color: #1f2937;
        margin: 20px 0;
      }
      .facts_section_card_description {
        color: #4b5563;
        font-size: 14px;
        margin-top: 8px;
      }
      .facts_section_card:nth-child(1) {
        background-color: #dbeafe;
      }
      .facts_section_card:nth-child(2) {
        background-color: #ede9fe;
      }
      .facts_section_card:nth-child(3) {
        background-color: #fef3c7;
      }
      .facts_section_card:nth-child(4) {
        background-color: #d1fae5;
      }
      .facts_section_card:nth-child(5) {
        background-color: #fce7f3;
      }
    </style>
    <style>
/* Add to your existing CSS */
.facts_section_container {
    text-align: center;
    width: 80%;
    margin: 60px auto;
    padding: 0 20px;
    padding-top: 20px;
}

.facts_section_subheading {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1f2937;
    margin-top: 15px;
    margin-bottom: 15px;
    background: linear-gradient(45deg, #2c3e50, #3498db);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.facts_section_description {
    color: #4b5563;
    margin-top: 10px;
    margin-bottom: 30px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* Testimonilas */
.testimonial-header {
    padding: 50px 0;
}

/* CTA */
/* Add to your existing CSS - Elegant CTA */
.elegant-cta {
  margin: 60px 0;
}

.elegant-cta .cta-inner {
  background: linear-gradient(135deg, #3a7bd5, #2b5876);
  border-radius: 16px;
  padding: 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  box-shadow: 0 10px 30px rgba(43, 88, 118, 0.15);
  position: relative;
  overflow: hidden;
}

.elegant-cta .cta-inner::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 300px;
  height: 100%;
  background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='rgba(255,255,255,0.075)' fill-rule='evenodd'/%3E%3C/svg%3E") center right;
  opacity: 0.4;
}

.cta-content-wrap {
  max-width: 70%;
}

.cta-title {
  color: white;
  font-size: 1.8rem;
  font-weight: 600;
  margin: 0 0 10px 0;
}

.cta-description {
  color: rgba(255, 255, 255, 0.85);
  font-size: 1rem;
  margin: 0;
}

.elegant-cta-button {
  display: flex;
  align-items: center;
  justify-content: center;
  background: white;
  color: #3a7bd5;
  padding: 12px 24px;
  border-radius: 8px;
  font-size: 1rem;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  white-space: nowrap;
  z-index: 9999;
}

.elegant-cta-button svg {
  margin-left: 8px;
  transition: transform 0.2s ease;
}

.elegant-cta-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}

.elegant-cta-button:hover svg {
  transform: translateX(4px);
}

@media (max-width: 768px) {
  .elegant-cta .cta-inner {
    flex-direction: column;
    text-align: center;
    padding: 30px 20px;
  }
  
  .cta-content-wrap {
    max-width: 100%;
    margin-bottom: 20px;
  }
  
  .cta-title {
    font-size: 1.5rem;
  }
}

/* Factes new */
.did-you-know-section {
    padding: 80px 0;
    
    position: relative;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

.knowledge-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
    max-width: 1000px;
    margin: 0 auto;
}

.knowledge-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-radius: 12px;
    background: white;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.knowledge-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
}

.knowledge-image-placeholder {
    width: 70px;
    height: 70px;
    min-width: 70px;
    border-radius: 12px;
    background: #f0f0f0;
    margin-right: 20px;
}

.knowledge-blue .knowledge-image-placeholder {
    background: linear-gradient(135deg, #3a7bd5, #2b5876);
}

.knowledge-purple .knowledge-image-placeholder {
    background: linear-gradient(135deg, #8e2de2, #4a00e0);
}

.knowledge-orange .knowledge-image-placeholder {
    background: linear-gradient(135deg, #f2994a, #f2c94c);
}

.knowledge-green .knowledge-image-placeholder {
    background: linear-gradient(135deg, #00b09b, #96c93d);
}

.knowledge-content {
    flex: 1;
}

.knowledge-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 8px;
    color: #2c3e50;
}

.knowledge-text {
    color: #666;
    font-size: 16px;
    line-height: 1.5;
    margin: 0;
}

@media (max-width: 768px) {
    .knowledge-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .did-you-know-section {
        padding: 60px 0;
    }
    
    .knowledge-image-placeholder {
        width: 60px;
        height: 60px;
        min-width: 60px;
    }
    
    .knowledge-title {
        font-size: 20px;
    }
    
    .knowledge-text {
        font-size: 15px;
    }
}

.t-container {
    padding: 50px 0;
}
@media (max-width: 768px) {
    .t-container {
    width: 80%;
    padding: 0px 0;
}
.facts_section_container {
    text-align: center;
    width: 80%;
    margin: 60px auto;
    padding: 0 20px;
    padding-top: 0px;
}
.did-you-know-section {
    padding: 80px 0;
    padding-top: 10px;
    position: relative;
}

.elegant-cta {
  margin: 20px 0;
}
}
</style>
    
<script>
        // Retrieve the country flag image based on user's IP
        fetch('https://ipgeolocation.abstractapi.com/v1/?api_key=f18d943c20974bd5b4d75474cfe2107a')
            .then(response => response.json())
            .then(data => {
                var countryCode = data.country_code.toLowerCase();
                var flagIconClass = 'flag-icon-' + countryCode;
                var flagImage = '<i class="flag-icon ' + flagIconClass + '"></i>';
                var usersCompleted = parseInt(localStorage.getItem('usersCompleted'), 10) || 7363;
                usersCompleted += 1;
                localStorage.setItem('usersCompleted', usersCompleted);

                var output = flagImage + ' <span class="bold-number">' + usersCompleted + '</span> users completed the test today';
                document.getElementById("output").innerHTML = output;
            })
            .catch(error => {
                console.log('Error:', error);
                document.getElementById("output").innerHTML = "Failed to retrieve flag image";
            });
    </script>

<div id="primary" <?php astra_primary_class(); ?>>
    <?php astra_primary_content_top(); ?>

    <section class="position-relative">
        <div class="container-xl py-5">
            <div class="row gy-4 align-items-center justify-content-between">
                <div class="col-md-6 col-lg-7">
                    <span class="small d-block"><?php echo $banner['overline']; ?></span>
                    <h1 class="home-banner-title h1 fw-bold"><?php echo $banner['title']; ?></h1>
                    <p class="mb-4"><?php echo $banner['content']; ?></p>
                  
                        <div id="output">Loading...</div><br>
                    
                    <div>
                        <a href="<?php echo $banner['link']['url']; ?>" class="button d-inline-flex btn-3d">
                            <span><?php echo $banner['link']['title']; ?></span>
                            <svg class="si ms-2 ps-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M317.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224C.9 240.7-2.6 254.8 2 267.3S18.7 288 32 288H143.5L66.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7H240.5L317.4 44.6z"/></svg>
                        </a>
                    </div>
                    <?php echo $banner['link_subtext']; ?>
                    <!-- <small>By taking test you agree to our <a href="#!" class="fw-semibold">terms & conditions</a>.</small> -->
                </div>
                
                <div class="col-md-5">
                    <img src="<?php echo (isset($banner['image']) && isset($banner['image']['url'])) ? $banner['image']['url'] : $tpl_dir_uri . '/img/home-front-2.png'; ?>" alt="image" class="rounded-4 w-100 h-auto" />
                </div>
            </div>
        </div>
    </section>

    <div class="position-relative home-counters">
        <div class="container-xl py-5 position-relative">
            <div class="row gy-4">
                <?php foreach ($counters as $key => $value) { ?>
                    <div class="col-6 col-lg-3 text-center">
                        <h4 class="display-6 mt-0 mb-2 fw-bold"><span class="counter" data-count="<?php echo $value['number']; ?>">0</span><?php echo $value['suffix']; ?></h4>
                        <p class="lead mb-0 mt-0 fw-semibold"><?php echo $value['title']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <section class="why-iq-test-section">
    <div class="container-xl">
       

    <div class="section-header">
    <h2 class="deviation-title" data-aos="fade-up">Why Take an IQ Test?</h2>
    <p class="text-center mb-5 text-muted" data-aos="fade-up" data-aos-delay="100">An IQ test isn't just about measuring intelligence—it's a doorway to personal insight and growth</p>
</div>

        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Spark a Defining Moment</h3>
                <p class="benefit-description">
                    IQ Test can jump-start your journey of self-discovery. Pinpointing your cognitive strengths can be the confidence boost you need to embrace new challenges and opportunities.
                </p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Measure Your Abilities Against the Crowd</h3>
                <p class="benefit-description">
                    With over 100,000 participants so far, our test offers a clear benchmark of how your cognitive profile compares to peers in your age group and beyond—giving you meaningful perspective on where you stand.
                </p>
            </div>

            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="benefit-title">Unlock Tailored Opportunities</h3>
                <p class="benefit-description">
                    Our reliable IQ test highlights your core aptitudes, helping you make smarter decisions about education and career. Let your newfound self-awareness be the key to unlocking your potential.
                </p>
            </div>
        </div>
    </div>
</section>
    <!-- <section class="my-5">
        <div class="container-xl">
            <div class="row gy-4 justify-content-around align-items-center">
                <div class="col-md-6 col-lg-6">
                    <span class="small d-block"><?php echo $info['overline']; ?></span>
                    <h2 class="h2 mb-2 fw-bold"><?php echo $info['title']; ?></h2>
                    <?php echo $info['content']; ?>
                </div>
                <div class="col-md-6 col-lg-5">
                    <img src="<?php echo (isset($info['image']) && $info['image']['url']) ? $info['image']['url'] : 'https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80'; ?>" alt="" style="border-bottom:5px solid var(--ast-global-color-0);" class="d-block mx-auto img-fluid rounded-4">
                </div>
            </div>
        </div>
    </section> -->
<!-- 
    <section class="my-5">
        <div class="container-xl">
            <h2 class="h2 fw-bold"><?php echo $charts['title']; ?></h2>
            <p><?php echo $charts['content']; ?></p>

            <div class="row gy-4">
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3 text-center"><?php echo $charts['charts'][0]['title']; ?></h3>
                    <img src="<?php echo ( isset($charts['charts'][0]['image']) && isset($charts['charts'][0]['image']['url']) ) ? $charts['charts'][0]['image']['url'] : 'https://dummyimage.com/720x450'; ?>" alt="image" class="w-100 h-auto">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3 text-center"><?php echo $charts['charts'][1]['title']; ?></h3>
                    <img src="<?php echo ( isset($charts['charts'][1]['image']) && isset($charts['charts'][1]['image']['url']) ) ? $charts['charts'][1]['image']['url'] : 'https://dummyimage.com/720x450'; ?>" alt="image" class="w-100 h-auto">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3 text-center"><?php echo $charts['charts'][2]['title']; ?></h3>
                    <img src="<?php echo ( isset($charts['charts'][2]['image']) && isset($charts['charts'][2]['image']['url']) ) ? $charts['charts'][2]['image']['url'] : 'https://dummyimage.com/720x450'; ?>" alt="image" class="w-100 h-auto">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3 text-center"><?php echo $charts['charts'][3]['title']; ?></h3>
                    <img src="<?php echo ( isset($charts['charts'][3]['image']) && isset($charts['charts'][3]['image']['url']) ) ? $charts['charts'][3]['image']['url'] : 'https://dummyimage.com/720x450'; ?>" alt="image" class="w-100 h-auto">
                </div>
                <div class="col-12">
                    <h3 class="fw-bold mb-3 text-center"><?php echo $charts['charts'][4]['title']; ?></h3>
                    <img src="<?php echo ( isset($charts['charts'][4]['image']) && isset($charts['charts'][4]['image']['url']) ) ? $charts['charts'][4]['image']['url'] : 'https://dummyimage.com/1280x450'; ?>" alt="image" class="w-100 h-auto">
                </div>
            </div>

        </div>
    </section>

    <section class="my-5">
        <div class="container-xl">
            <h3 class="h3 fw-bold mb-3 text-center"><?php
                if( isset($iq_countries['title']) && trim($iq_countries['title']) !== '' ){
                    echo $iq_countries['title'];
                } else {
                    echo $charts['charts'][5]['title'];
                }
            ?></h3>
            <?php if( isset($charts['charts'][5]['image']) && isset($charts['charts'][5]['image']['url']) && trim($charts['charts'][5]['image']['url']) !== '' ){ ?>
                <img src="<?php echo ( isset($charts['charts'][5]['image']) && isset($charts['charts'][5]['image']['url']) ) ? $charts['charts'][5]['image']['url'] : 'https://dummyimage.com/1280x450'; ?>" alt="image" class="w-100 h-auto">
            <?php } else if( isset($iq_countries['countries']) && is_iterable($iq_countries['countries']) && count($iq_countries['countries']) ){ ?>
                <div class="mt-4">
                    <div class="row gy-4 px-4">
                        <?php foreach ($iq_countries['countries'] as $key => $country) { ?>
                            <div class="col-sm-6 col-md-4">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="<?php echo $country['image']['url']; ?>" alt="flag" style="width:50px;border-radius:5px;" class="h-auto">
                                    </div>
                                    <div class="col-auto">
                                        <span><span class="fw-semibold"><?php echo $country['title']; ?></span> · <span class="lead"><?php echo $country['score']; ?></span></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section> -->
    <section class="famous-people-section">
        <div class="container-xl">
            <h2 class="deviation-title text-center" data-aos="fade-up">Brilliant Minds & Their IQ Scores</h2>
            <p class="text-center mb-5 text-muted" data-aos="fade-up" data-aos-delay="100">Discover the intelligence quotients of some of most remarkable individuals</p>
            
            <div class="famous-people-grid">
                <?php
                $famous_people = array(
                    array(
                        'name' => 'Andre Tate',
                        'iq' => '148',
                        'image_placeholder' => 'https://static.ffx.io/images/$zoom_2.3309%2C$multiply_0.5855%2C$ratio_1%2C$width_1059%2C$x_678%2C$y_162/t_crop_custom/q_86%2Cf_auto/89dcd9ed59d16f7c77f001daa35c38e30b16c8dc',
                        'achievement' => 'Entrepreneur & Professional Kickboxer'
                    ),
                    array(
                        'name' => 'William Shakespeare',
                        'iq' => '210',
                        'image_placeholder' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRT87OblnIjVNcQ1R97nXI_MXzX07kM_40A27VUr08F0wMzJ2LoTcTercy5cvm1pA3CnA8oGxlXFl3smSeXzoP3bw',
                        'achievement' => 'Greatest Dramatist of All Time'
                    ),
                    array(
                        'name' => 'Magnus Carlsen',
                        'iq' => '190',
                        'image_placeholder' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRK23rnfuxqvlciljWvXz14AjmZHQqEjfbwj0FaFtdfGH7iX-SO8kCMAf1KeqH6MG6tv5GAc6rCu-woMmYQoLVhRA',
                        'achievement' => 'World Chess Champion'
                    ),
                    array(
                        'name' => 'Sam Altman',
                        'iq' => '165',
                        'image_placeholder' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQon1HLDySJA66yMFj51kDYptfEiuOPWQ-PdO5FI-3vfQArM4EnAS64Upe-riR1GPt_nsOykmsVXlgJikkiquChXIZbD1Zh6eLD_7OPPQ',
                        'achievement' => 'CEO of OpenAI'
                    ),
                    array(
                        'name' => 'Vitalik Buterin',
                        'iq' => '157',
                        'image_placeholder' => 'https://imageio.forbes.com/specials-images/imageserve/618e9029984a5e65860f9cff/0x0.jpg?format=jpg&crop=1466,1467,x122,y214,safe&height=416&width=416&fit=bounds',
                        'achievement' => 'Ethereum Co-founder'
                    ),
                    array(
                        'name' => 'Isaac Newton',
                        'iq' => '190',
                        'image_placeholder' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/Portrait_of_Sir_Isaac_Newton%2C_1689_%28brightened%29.jpg/1200px-Portrait_of_Sir_Isaac_Newton%2C_1689_%28brightened%29.jpg',
                        'achievement' => 'Father of Modern Physics'
                    ),
                    array(
                        'name' => 'Albert Einstein',
                        'iq' => '160',
                        'image_placeholder' => 'https://3.imimg.com/data3/UV/II/MY-6587879/albert-einstein-portrait.jpg',
                        'achievement' => 'Theory of Relativity Pioneer'
                    ),
                    array(
                        'name' => 'Thomas Edison',
                        'iq' => '167',
                        'image_placeholder' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9d/Thomas_Edison2.jpg/1200px-Thomas_Edison2.jpg',
                        'achievement' => 'Prolific Inventor'
                    ),
                    array(
                        'name' => 'Taylor Swift',
                        'iq' => '160',
                        'image_placeholder' => 'https://daily.jstor.org/wp-content/uploads/2020/09/the_linguistic_evolution_of_taylor_swift_1050x700.jpg',
                        'achievement' => 'Multiple Grammy Winner'
                    ),
                    array(
                        'name' => 'Oppenheimer',
                        'iq' => '135',
                        'image_placeholder' => 'https://upload.wikimedia.org/wikipedia/commons/8/85/Oppenheimer_%28cropped%29.jpg',
                        'achievement' => 'Father of Atomic Bomb'
                    ),
                    array(
                        'name' => 'Mark Zuckerberg',
                        'iq' => '152',
                        'image_placeholder' => 'https://upload.wikimedia.org/wikipedia/commons/1/18/Mark_Zuckerberg_F8_2019_Keynote_%2832830578717%29_%28cropped%29.jpg',
                        'achievement' => 'Meta Founder & CEO'
                    ),
                    array(
                        'name' => 'Elon Musk',
                        'iq' => '160',
                        'image_placeholder' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRaXB32WHIp5E32Kyk9az1E8wpVCmlTBHkonw&s',
                        'achievement' => 'Tesla & SpaceX CEO'
                    )
                );

                foreach ($famous_people as $index => $person) : ?>
                    <div class="famous-person-card" data-aos="fade-up" data-aos-delay="<?php echo $index * 50; ?>">
                        <div class="person-header">
                            <div class="person-image-wrapper">
                                <img src="<?php echo $person['image_placeholder']; ?>" 
                                     alt="<?php echo $person['name']; ?>" 
                                     class="famous-person-image">
                                <div class="verified-badge">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="person-info">
                                <h3 class="person-name"><?php echo $person['name']; ?></h3>
                                <div class="iq-score">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M2 10h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zm9-9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zm0 9h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-3a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1zM2 1h3a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                    </svg>
                                    IQ: <?php echo $person['iq']; ?>
                                </div>
                            </div>
                        </div>
                        <p class="person-achievements"><?php echo $person['achievement']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<section class="elegant-cta">
  <div class="container">
    <div class="cta-inner">
      <div class="cta-content-wrap">
        <h3 class="cta-title">Discover your cognitive potential today</h3>
        <p class="cta-description">Join 150,000+ people who've measured their intellectual abilities</p>
      </div>
      <a href="/test/" id="cta-start-button" class="elegant-cta-button">
        Start IQ Test
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 4L10.59 5.41L16.17 11H4V13H16.17L10.59 18.59L12 20L20 12L12 4Z" fill="currentColor"/>
        </svg>
      </a>
    </div>
  </div>
</section>



    <section class="iq-deviation-section">
    <div class="container-xl">
        <div class="deviation-header">
            <h2 class="deviation-title">IQ Score Distribution Bell Curve</h2>
            <p class="deviation-description">
                A deviation IQ has a mean (average) of 100 and a standard deviation of 15 IQ points. This means that about two-thirds of the population scores between 85 and 115, and about 95% score between 70 and 130.
            </p>
        </div>

        <div class="graph-container">
            <!-- Placeholder for the bell curve graph -->
            <img src="https://i.ibb.co/HTD7TzV0/28044b2b-49c2-4c02-ac79-1f9e43d3af91.png" 
                 alt="IQ Distribution Bell Curve" 
                 class="graph-placeholder">
        </div>

        <h2 class="stanford-title">Stanford-Binet IQ Score Ranges</h2>

        <div class="iq-categories-grid">
            <div class="iq-category-card">
                <div class="category-score">145+</div>
                <div class="category-label">Genius or near genius</div>
                <p class="category-description">Top 1% of the population, exceptional cognitive ability</p>
            </div>

            <div class="iq-category-card">
                <div class="category-score">130-144</div>
                <div class="category-label">Gifted</div>
                <p class="category-description">Superior cognitive ability, high intellectual potential</p>
            </div>

            <div class="iq-category-card">
                <div class="category-score">115-129</div>
                <div class="category-label">Above Average</div>
                <p class="category-description">Strong cognitive abilities, quick learning capability</p>
            </div>

            <div class="iq-category-card">
                <div class="category-score">85-114</div>
                <div class="category-label">Average</div>
                <p class="category-description">Normal cognitive development, typical intelligence range</p>
            </div>

            <div class="iq-category-card">
                <div class="category-score">70-84</div>
                <div class="category-label">Below Average</div>
                <p class="category-description">May experience some learning difficulties</p>
            </div>

            <div class="iq-category-card">
                <div class="category-score">Below 70</div>
                <div class="category-label">Extremely Low</div>
                <p class="category-description">Significant cognitive challenges present</p>
            </div>
        </div>
    </div>
</section>

<div class="iq-container">
        <h1 class="deviation-title">Global IQ Score Average</h1>
        
        <div class="iq-country-main">
            <div class="iq-country-info">
                <div class="iq-flag-main">
                    <span class="flag-icon flag-icon-in" style="width: 100%; height: 100%;"></span>
                </div>
                <div>
                    <h2 class="iq-country-title">India</h2>
                    <p class="iq-country-subtitle">Your Country's Average IQ Score</p>
                </div>
            </div>
            <div class="iq-score-main">96</div>
        </div>
        
        <div class="iq-country-grid" id="iqCountryGrid">
            <!-- Countries will be populated by JavaScript -->
        </div>
    </div>
    <section class="statistics-section">
    <div class="statistics-container">
        <div class="section-heading">
            <h2 class="deviation-title">Intelligence Insights</h2>
            <p class="section-subtitle">Explore data patterns across demographics based on our comprehensive research</p>
        </div>

        <!-- Center Pie Chart -->
        <div class="chart-card featured-chart">
            <div class="chart-content">
                <h3 class="chart-title">Gender Distribution</h3>
                <div class="chart-wrapper">
                    <canvas id="genderChart"></canvas>
                </div>
                <div class="chart-legend">
                    <div class="legend-item">
                        <span class="legend-color" style="background: rgba(54, 162, 235, 0.8)"></span>
                        <span class="legend-label">Male (65%)</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-color" style="background: rgba(255, 99, 132, 0.8)"></span>
                        <span class="legend-label">Female (35%)</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="charts-grid">
            <!-- Academic Level Chart -->
            <div class="chart-card">
                <div class="chart-content">
                    <h3 class="chart-title">Academic Achievement</h3>
                    <div class="chart-wrapper">
                        <canvas id="studyLevelChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Study Field Chart -->
            <div class="chart-card">
                <div class="chart-content">
                    <h3 class="chart-title">IQ by Field of Study</h3>
                    <div class="chart-wrapper">
                        <canvas id="studyFieldChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Age Distribution Chart -->
        <div class="chart-card wide-chart">
            <div class="chart-content">
                <h3 class="chart-title">Age Demographics</h3>
                <div class="chart-wrapper">
                    <canvas id="ageChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
<section class="did-you-know-section">
    <div class="container">
        <div class="section-header">
            <h2 class="deviation-title">Did You Know?</h2>
            <p class="section-subtitle">Fascinating facts about intelligence quotient distribution</p>
        </div>
        
        <div class="knowledge-grid">
            <div class="knowledge-item knowledge-blue" data-aos="fade-up">
                <div class="knowledge-image-placeholder">
                    <img src="https://i.ibb.co/Fb1ST7Bw/Screenshot-2025-03-05-103426.png"/>
                </div>
                <div class="knowledge-content">
                    <div class="knowledge-title">1 in 47</div>
                    <p class="knowledge-text">Only 2.1% of the world's population has an IQ above 130.</p>
                </div>
            </div>
            
            <div class="knowledge-item knowledge-purple" data-aos="fade-up" data-aos-delay="100">
                <div class="knowledge-image-placeholder">
                <img src="https://i.ibb.co/Wv24YYNz/Screenshot-2025-03-05-103437.png"/>
                </div>
                <div class="knowledge-content">
                    <div class="knowledge-title">1 in 465</div>
                    <p class="knowledge-text">Only 0.21% individuals have IQ above 150.</p>
                </div>
            </div>
            
            <div class="knowledge-item knowledge-orange" data-aos="fade-up" data-aos-delay="200">
                <div class="knowledge-image-placeholder">
                <img src="https://i.ibb.co/C5xvwsJj/Screenshot-2025-03-05-103448.png"/>
                </div>
                <div class="knowledge-content">
                    <div class="knowledge-title">Speed Matters</div>
                    <p class="knowledge-text">IQ scores are partly influenced by how quickly you solve problems.</p>
                </div>
            </div>
            
            <div class="knowledge-item knowledge-green" data-aos="fade-up" data-aos-delay="300">
                <div class="knowledge-image-placeholder">
                <img src="https://i.ibb.co/p6g4mr3d/Screenshot-2025-03-05-103459.png"/>
                </div>
                <div class="knowledge-content">
                    <div class="knowledge-title">High IQ Society</div>
                    <p class="knowledge-text">Mensa only accepts people in the top 2% of IQ scores.</p>
                </div>
            </div>
        </div>
    </div>
</section>
    
<!-- <div class="container">
      <h1>Global IQ Distribution <span>2025</span></h1>
      <div class="map-container">
        <div id="world-map"></div>
        <div class="legend">
          <div class="legend-item">
            <span class="dot low"></span>
            <p>< 95</p>
          </div>
          <div class="legend-item">
            <span class="dot medium"></span>
            <p>95 - 100</p>
          </div>
          <div class="legend-item">
            <span class="dot high"></span>
            <p>> 100</p>
          </div>
        </div>
      </div>
      <div id="stats-popup" class="stats-popup">
        <div class="stats-header">
          <h3 id="country-name">Country Name</h3>
          <span class="close-btn">&times;</span>
        </div>
        <div class="stats-content">
          <div class="stat-item">
            <span class="stat-label">Average IQ:</span>
            <span id="iq-score" class="stat-value">0</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Global Rank:</span>
            <span id="global-rank" class="stat-value">#0</span>
          </div>
          <div class="stat-item">
            <span class="stat-label">Population:</span>
            <span id="population" class="stat-value">0M</span>
          </div>
          <div id="chart-container" class="chart-container">
            <canvas id="stat-chart"></canvas>
          </div>
        </div>
      </div>
    </div> -->

    <div class="facts_section_container">
  <h1 class="deviation-title">What does IQ test measure?</h1>
  <p class="facts_section_description">
    Discover the key areas of intelligence evaluated in standardized IQ
    assessments
  </p>

  <div class="facts_section_grid">
    <div class="facts_section_card">
      <div class="facts_section_card_icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
          <polyline points="2 17 12 22 22 17"></polyline>
          <polyline points="2 12 12 17 22 12"></polyline>
        </svg>
      </div>
      <h3 class="facts_section_card_title">Abstract Reasoning</h3>
      <p class="facts_section_card_description">
        The ability to analyze information and solve complex problems
        through conceptual thinking.
      </p>
    </div>
    <div class="facts_section_card">
      <div class="facts_section_card_icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <rect x="3" y="3" width="7" height="7"></rect>
          <rect x="14" y="3" width="7" height="7"></rect>
          <rect x="14" y="14" width="7" height="7"></rect>
          <rect x="3" y="14" width="7" height="7"></rect>
        </svg>
      </div>
      <h3 class="facts_section_card_title">Pattern Recognition</h3>
      <p class="facts_section_card_description">
        The ability to identify order and relationships in seemingly
        unrelated data or visual elements.
      </p>
    </div>
    <div class="facts_section_card">
      <div class="facts_section_card_icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
      </div>
      <h3 class="facts_section_card_title">Deductive Reasoning</h3>
      <p class="facts_section_card_description">
        The ability to draw logical conclusions from given premises and
        apply rules to specific situations.
      </p>
    </div>
    <div class="facts_section_card">
      <div class="facts_section_card_icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="8" y1="6" x2="21" y2="6"></line>
          <line x1="8" y1="12" x2="21" y2="12"></line>
          <line x1="8" y1="18" x2="21" y2="18"></line>
          <line x1="3" y1="6" x2="3.01" y2="6"></line>
          <line x1="3" y1="12" x2="3.01" y2="12"></line>
          <line x1="3" y1="18" x2="3.01" y2="18"></line>
        </svg>
      </div>
      <h3 class="facts_section_card_title">Numerical Reasoning</h3>
      <p class="facts_section_card_description">
        The ability to understand, interpret, and manipulate mathematical
        concepts and numerical data.
      </p>
    </div>
    <div class="facts_section_card">
    <div class="facts_section_card_icon">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
  <circle cx="6" cy="12" r="2"/>
  <circle cx="12" cy="6" r="2"/>
  <circle cx="12" cy="18" r="2"/>
  <circle cx="18" cy="12" r="2"/>
  <path d="M7.5 10.5 L10.5 7.5"/>
  <path d="M16.5 7.5 L13.5 10.5"/>
  <path d="M7.5 13.5 L10.5 16.5"/>
  <path d="M16.5 16.5 L13.5 13.5"/>
</svg>
      </div>
      <h3 class="facts_section_card_title">Cognitive Ability</h3>
      <p class="facts_section_card_description">
        The general capacity for information processing, including memory,
        attention, and mental agility.
      </p>
    </div>
  </div>
</div>

</section>
<div class="t-container container">
    <div class="testimonial-header">
        <h2 class="deviation-title text-center">Trusted By Professionals Worldwide</h2>
        <p class="text-center mb-5 text-muted">Discover how our IQ test has helped people gain valuable insights into their cognitive abilities</p>
    </div>
    <?php echo do_shortcode('[sp_testimonial id="2526"]'); ?>
</div>
<script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/topojson@3.0.2/dist/topojson.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- World map -->
     <!-- <script>
        // World data and map rendering logic
document.addEventListener("DOMContentLoaded", function () {
  // Sample data for countries and IQ statistics
  const countries = [
    {
      name: "United States",
      lat: 37.0902,
      lon: -95.7129,
      iq: 98,
      population: "331M",
      rank: 29,
      trend: [97, 97.5, 98, 98, 98, 98, 98],
    },
    {
      name: "India",
      lat: 20.5937,
      lon: 78.9629,
      iq: 105,
      population: "1.38B",
      rank: 17,
      trend: [100, 101, 102, 103, 104, 104.5, 105],
    },
    {
      name: "Italy",
      lat: 41.8719,
      lon: 12.5674,
      iq: 104,
      population: "60M",
      rank: 18,
      trend: [102, 102.5, 103, 103.5, 104, 104, 104],
    },
    {
      name: "Brazil",
      lat: -14.235,
      lon: -51.9253,
      iq: 97,
      population: "212M",
      rank: 31,
      trend: [95, 95.5, 96, 96.5, 97, 97, 97],
    },
    {
      name: "China",
      lat: 35.8617,
      lon: 104.1954,
      iq: 107,
      population: "1.41B",
      rank: 8,
      trend: [103, 104, 105, 106, 106.5, 107, 107],
    },
    {
      name: "Japan",
      lat: 36.2048,
      lon: 138.2529,
      iq: 112,
      population: "126M",
      rank: 3,
      trend: [110, 110.5, 111, 111.5, 112, 112, 112],
    },
    {
      name: "Germany",
      lat: 51.1657,
      lon: 10.4515,
      iq: 107,
      population: "83M",
      rank: 9,
      trend: [105, 105.5, 106, 106.5, 107, 107, 107],
    },
    {
      name: "Russia",
      lat: 61.524,
      lon: 105.3188,
      iq: 103,
      population: "144M",
      rank: 19,
      trend: [101, 101.5, 102, 102.5, 103, 103, 103],
    },
    {
      name: "South Korea",
      lat: 35.9078,
      lon: 127.7669,
      iq: 109,
      population: "51M",
      rank: 6,
      trend: [106, 107, 108, 108.5, 109, 109, 109],
    },
    {
      name: "United Kingdom",
      lat: 55.3781,
      lon: -3.436,
      iq: 100,
      population: "67M",
      rank: 24,
      trend: [99, 99.5, 100, 100, 100, 100, 100],
    },
    {
      name: "France",
      lat: 46.2276,
      lon: 2.2137,
      iq: 99,
      population: "65M",
      rank: 25,
      trend: [98, 98.5, 99, 99, 99, 99, 99],
    },
    {
      name: "Australia",
      lat: -25.2744,
      lon: 133.7751,
      iq: 99,
      population: "25M",
      rank: 26,
      trend: [97, 98, 98.5, 99, 99, 99, 99],
    },
    {
      name: "Canada",
      lat: 56.1304,
      lon: -106.3468,
      iq: 101,
      population: "38M",
      rank: 21,
      trend: [99, 99.5, 100, 100.5, 101, 101, 101],
    },
    {
      name: "Singapore",
      lat: 1.3521,
      lon: 103.8198,
      iq: 108,
      population: "5.8M",
      rank: 7,
      trend: [105, 106, 107, 107.5, 108, 108, 108],
    },
    {
      name: "Spain",
      lat: 40.4637,
      lon: -3.7492,
      iq: 98,
      population: "47M",
      rank: 28,
      trend: [96, 97, 97.5, 98, 98, 98, 98],
    },
  ];

  // Create world map using D3.js
  const width = document.getElementById("world-map").clientWidth;
  const height = document.getElementById("world-map").clientHeight;

  // Create SVG
  const svg = d3
    .select("#world-map")
    .append("svg")
    .attr("width", width)
    .attr("height", height);

  // Create a projection
  const projection = d3
    .geoMercator()
    .scale(width / (2 * Math.PI))
    .translate([width / 2, height / 1.5]);

  // Create a path generator
  const path = d3.geoPath().projection(projection);

  // Load and display the world map
  Promise.all([
    d3.json("https://cdn.jsdelivr.net/npm/world-atlas@2/countries-110m.json"),
  ])
    .then((data) => {
      const world = data[0];

      // Draw countries
      svg
        .selectAll("path")
        .data(topojson.feature(world, world.objects.countries).features)
        .enter()
        .append("path")
        .attr("class", "country")
        .attr("d", path);

      // Add dots for countries with IQ data
      countries.forEach((country) => {
        const [x, y] = projection([country.lon, country.lat]);

        if (x && y) {
          // Make sure the point is within projection bounds
          // Determine color category based on IQ
          let category;
          if (country.iq < 95) {
            category = "low";
          } else if (country.iq >= 95 && country.iq <= 100) {
            category = "medium";
          } else {
            category = "high";
          }

          // Create dots
          const dot = document.createElement("div");
          dot.className = `map-dot ${category}`;
          dot.style.left = `${x}px`;
          dot.style.top = `${y}px`;
          dot.setAttribute("data-name", country.name);
          dot.setAttribute("data-iq", country.iq);
          dot.setAttribute("data-population", country.population);
          dot.setAttribute("data-rank", country.rank);
          dot.setAttribute("data-trend", JSON.stringify(country.trend));

          document.getElementById("world-map").appendChild(dot);

          // Add event listeners
          dot.addEventListener("click", showStats);
        }
      });
    })
    .catch((error) => {
      console.error("Error loading map data:", error);
    });

  // Chart instance
  let statChart = null;

  // Function to show statistics
  function showStats(e) {
    const dot = e.target;
    const popup = document.getElementById("stats-popup");

    // Get data from dot attributes
    const name = dot.getAttribute("data-name");
    const iq = dot.getAttribute("data-iq");
    const population = dot.getAttribute("data-population");
    const rank = dot.getAttribute("data-rank");
    const trend = JSON.parse(dot.getAttribute("data-trend"));

    // Update popup content
    document.getElementById("country-name").textContent = name;
    document.getElementById("iq-score").textContent = iq;
    document.getElementById("global-rank").textContent = `#${rank}`;
    document.getElementById("population").textContent = population;

    // Position popup near the dot
    const dotRect = dot.getBoundingClientRect();
    const containerRect = document
      .querySelector(".map-container")
      .getBoundingClientRect();

    const top = dotRect.top - containerRect.top;
    const left = dotRect.left - containerRect.left + 20;

    // Ensure popup stays within the container boundaries
    popup.style.top = `${top}px`;
    popup.style.left = `${left}px`;

    // Show popup
    popup.style.display = "block";

    // Create chart
    createChart(trend);
  }

  // Function to create chart
  function createChart(data) {
    const ctx = document.getElementById("stat-chart").getContext("2d");

    // Destroy previous chart if it exists
    if (statChart) {
      statChart.destroy();
    }

    statChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: ["2019", "2020", "2021", "2022", "2023", "2024", "2025"],
        datasets: [
          {
            label: "IQ Trend",
            data: data,
            borderColor: "#6bb5ff",
            backgroundColor: "rgba(107, 181, 255, 0.1)",
            borderWidth: 2,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: "#ffffff",
            pointRadius: 3,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          },
          tooltip: {
            callbacks: {
              label: function (context) {
                return `IQ: ${context.parsed.y}`;
              },
            },
          },
        },
        scales: {
          y: {
            beginAtZero: false,
            min: Math.floor(Math.min(...data) - 5),
            max: Math.ceil(Math.max(...data) + 5),
            grid: {
              color: "rgba(255, 255, 255, 0.05)",
            },
            ticks: {
              color: "rgba(255, 255, 255, 0.7)",
            },
          },
          x: {
            grid: {
              display: false,
            },
            ticks: {
              color: "rgba(255, 255, 255, 0.7)",
            },
          },
        },
      },
    });
  }

  // Close popup when clicking the close button
  document.querySelector(".close-btn").addEventListener("click", function () {
    document.getElementById("stats-popup").style.display = "none";
  });

  // Close popup when clicking outside
  document.addEventListener("click", function (e) {
    const popup = document.getElementById("stats-popup");
    const clickedOnDot = e.target.classList.contains("map-dot");
    const clickedInsidePopup = popup.contains(e.target);

    if (!clickedOnDot && !clickedInsidePopup) {
      popup.style.display = "none";
    }
  });

  // Handle window resize
  window.addEventListener("resize", function () {
    document.getElementById("stats-popup").style.display = "none";
  });
});

     </script> -->
<script>
    
// Helper function to create gradient
function createGradient(ctx, colorStart, colorEnd) {
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, colorStart);
    gradient.addColorStop(1, colorEnd);
    return gradient;
}

// Gender Distribution Chart
const genderCtx = document.getElementById('genderChart').getContext('2d');
new Chart(genderCtx, {
    type: 'doughnut',
    data: {
        labels: ['Male', 'Female'],
        datasets: [{
            data: [65, 35],
            backgroundColor: [
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 99, 132, 0.8)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        cutout: '70%'
    }
});

// Study Level Distribution Chart
const studyLevelCtx = document.getElementById('studyLevelChart').getContext('2d');
const studyLevelGradient = createGradient(studyLevelCtx, 'rgba(54, 162, 235, 0.8)', 'rgba(54, 162, 235, 0.2)');

new Chart(studyLevelCtx, {
    type: 'bar',
    data: {
        labels: ['High School', 'Bachelor', 'Master', 'PhD', 'Other'],
        datasets: [{
            data: [25, 40, 20, 10, 5],
            backgroundColor: studyLevelGradient,
            borderRadius: 8,
            barPercentage: 0.6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.parsed.y + '%';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    color: 'rgba(0, 0, 0, 0.05)'
                },
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    },
                    font: {
                        size: 11
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            }
        }
    }
});

// Study Field Distribution Chart
const studyFieldCtx = document.getElementById('studyFieldChart').getContext('2d');
const studyFieldGradient = createGradient(studyFieldCtx, 'rgba(75, 192, 192, 0.8)', 'rgba(75, 192, 192, 0.2)');

new Chart(studyFieldCtx, {
    type: 'bar',
    data: {
        labels: ['Engineering', 'Science', 'Business', 'Arts', 'Medicine', 'Other'],
        datasets: [{
            data: [115, 112, 108, 105, 118, 106],
            backgroundColor: studyFieldGradient,
            borderRadius: 8,
            barPercentage: 0.6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                min: 100,
                max: 120,
                grid: {
                    display: true,
                    color: 'rgba(0, 0, 0, 0.05)'
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            }
        }
    }
});

// Age Distribution Chart
const ageCtx = document.getElementById('ageChart').getContext('2d');
const ageGradient = createGradient(ageCtx, 'rgba(153, 102, 255, 0.8)', 'rgba(153, 102, 255, 0.2)');

new Chart(ageCtx, {
    type: 'bar',
    data: {
        labels: ['18-24', '25-34', '35-44', '45-54', '55+'],
        datasets: [{
            data: [30, 35, 20, 10, 5],
            backgroundColor: ageGradient,
            borderRadius: 8,
            barPercentage: 0.6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.parsed.y + '%';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    display: true,
                    color: 'rgba(0, 0, 0, 0.05)'
                },
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    },
                    font: {
                        size: 11
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            }
        }
    }
});
</script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Country data with ISO codes for flags
            const countriesData = [
                { name: "USA", score: 98, code: "us" },
                { name: "Singapore", score: 108, code: "sg" },
                { name: "South Korea", score: 106, code: "kr" },
                { name: "China", score: 105, code: "cn" },
                { name: "Japan", score: 105, code: "jp" },
                { name: "Brazil", score: 97, code: "br" },
                { name: "Italy", score: 102, code: "it" },
                { name: "Iceland", score: 101, code: "is" },
                { name: "Germany", score: 99, code: "de" },
                { name: "Switzerland", score: 101, code: "ch" },
                { name: "Spain", score: 102, code: "es" },
                { name: "France", score: 101, code: "fr" },
                { name: "Saudi Arabia", score: 95, code: "sa" },
                { name: "Argentina", score: 92, code: "ar" },
                { name: "United Kingdom", score: 100, code: "gb" }
            ];
            
            const countryGrid = document.getElementById('iqCountryGrid');
            
            // Create and append country cards with staggered animation
            countriesData.forEach((country, index) => {
                const countryCard = document.createElement('div');
                countryCard.className = 'iq-country-card';
                countryCard.style.opacity = '0';
                countryCard.style.transform = 'translateY(20px)';
                countryCard.style.transition = `all 0.4s ease ${index * 0.05}s`;
                
                countryCard.innerHTML = `
                    <div class="iq-flag-wrap">
                        <div class="iq-flag">
                            <span class="flag-icon flag-icon-${country.code}" style="width: 100%; height: 100%;"></span>
                        </div>
                        <span class="iq-country-name">${country.name}</span>
                    </div>
                    <span class="iq-score">${country.score}</span>
                `;
                
                countryGrid.appendChild(countryCard);
                
                // Trigger animation after a small delay
                setTimeout(() => {
                    countryCard.style.opacity = '1';
                    countryCard.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
    </script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>
    <?php astra_content_page_loop(); ?>
    <?php astra_primary_content_bottom(); ?>
</div><!-- #primary -->

<?php
if ( astra_page_layout() == 'right-sidebar' ){
    get_sidebar();
}
get_footer();
