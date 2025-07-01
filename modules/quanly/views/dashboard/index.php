<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use app\widgets\echarts\EChartAsset;
use yii\bootstrap5\Modal;

EChartAsset::register($this);

// Đăng ký tài nguyên
$this->registerJsFile('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');
$this->registerCssFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_HEAD]);
?>

<style>
.dashboard-container {
    background-color: #f8f9fa;
    padding: 20px;
    min-height: 100vh;
}

.block-themed {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 10px;
    overflow: hidden;
}

.block-themed:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.chart-container {
    height: 300px;
    width: 100%;
}

#map {
    height: 400px;
    border-radius: 10px;
}
</style>

<div class="dashboard-container">
    <h1 class="mb-4 text-primary">Thống kê cây</h1>

    <!-- Thẻ Thống Kê -->
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="block block-themed stat-card text-center">
                <div class="block-header bg-primary-dark d-flex align-items-center justify-content-center">
                    <i class="fas fa-tree text-white fa-2x me-2"></i>
                    <h3 class="block-title fs-4 fw-bold text-white">Cây cà phê</h3>
                </div>
                <div class="block-content p-4">
                    <div class="fs-1 fw-bold text-primary"><?= $thongke['CayCaPhe'] ?></div>
                    <a href="#"
                        class="btn btn-outline-primary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-themed stat-card text-center">
                <div class="block-header bg-success d-flex align-items-center justify-content-center">
                    <i class="fas fa-tree text-white fa-2x me-2"></i>
                    <h3 class="block-title fs-4 fw-bold text-white">Cây chuối</h3>
                </div>
                <div class="block-content p-4">
                    <div class="fs-1 fw-bold text-success"><?= $thongke['CayChuoi'] ?></div>
                    <a href="#"
                        class="btn btn-outline-primary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-themed stat-card text-center">
                <div class="block-header bg-warning d-flex align-items-center justify-content-center">
                    <i class="fas fa-tree text-white fa-2x me-2"></i>
                    <h3 class="block-title fs-4 fw-bold text-white">Cây gạo vàng</h3>
                </div>
                <div class="block-content p-4">
                    <div class="fs-1 fw-bold text-warning"><?= $thongke['CayGaoVang'] ?></div>
                    <a href="#"
                        class="btn btn-outline-primary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-themed stat-card text-center">
                <div class="block-header bg-info d-flex align-items-center justify-content-center">
                    <i class="fas fa-tree text-white fa-2x me-2"></i>
                    <h3 class="block-title fs-4 fw-bold text-white">Cây ngàn hoa</h3>
                </div>
                <div class="block-content p-4">
                    <div class="fs-1 fw-bold text-info"><?= $thongke['CayNganHoa'] ?></div>
                    <a href="#"
                        class="btn btn-outline-primary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="block block-themed stat-card text-center">
                <div class="block-header bg-danger d-flex align-items-center justify-content-center">
                    <i class="fas fa-tree text-white fa-2x me-2"></i>
                    <h3 class="block-title fs-4 fw-bold text-white">Cây sen khác</h3>
                </div>
                <div class="block-content p-4">
                    <div class="fs-1 fw-bold text-danger"><?= $thongke['CaySenKhac'] ?></div>
                    <a href="#"
                        class="btn btn-outline-primary mt-2">Xem chi tiết</a>
                </div>
            </div>
        </div>
        
    </div>

    

</div>


