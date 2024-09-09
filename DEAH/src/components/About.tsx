import "../Style/main.js";
import "react-slideshow-image/dist/styles.css";
import "../App.css";
import Header from "./Header.js";
import Footer from "./Footer.js";
const About = () => {
    return (
        <div>
            <Header status={true}/>
            <main>
                <section className="breadcrumbs-area breadcrumb-bg">
                    <div className="container">
                        <h1
                            className="title wow fadeInUp"
                            data-wow-delay="0.0s"
                        >
                            Về Chúng Tôi
                        </h1>
                        <div className="breadcrumb-text">
                            <nav
                                aria-label="breadcrumb"
                                className="breadcrumb-nav wow fadeInUp"
                                data-wow-delay="0.1s"
                            >
                                <ul className="breadcrumb listing">
                                    <li className="breadcrumb-item single-list">
                                        <a href="index" className="single">
                                            Trang chủ
                                        </a>
                                    </li>
                                    <li
                                        className="breadcrumb-item single-list"
                                        aria-current="page"
                                    >
                                        <a
                                            href="javascript:void(0)"
                                            className="single active"
                                        >
                                            Về Chúng Tôi
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </section>

                {/*/ End-of Breadcrumbs*/}
                {/* Về Us area S t a r t */}
                <br />
                <h1 className="text-center font-bold">
                    CHÀO MỪNG ĐẾN VỚI DEAH TOUR
                </h1>
                <br />
                <h2 className="text-center font-bold">DEAH TOUR</h2>
                <h3 className="text-center font-bold">Sống, Đậm Chất Riêng</h3>
                <div className="container my-5">
                    <div className="row">
                        <div className="col-md-6">
                            <img
                                src="https://ik.imagekit.io/tvlk/image/imageResource/2022/10/31/1667232016060-4b5babb4a860fb692d969ae3480cc6a1.png?tr=q-75"
                                width={400}
                                alt="Booking Du Lịch"
                            />
                        </div>
                        <div className="col-md-6">
                            <p className=" text-secondary font-semibold  ">
                              <br />
                              <br /><br />
                                DEAH TOUR là siêu ứng dụng du lịch và tiện ích
                                sống hàng đầu Việt Nam, chúng tôi giúp bạn khám
                                phá và mua đa dạng các loại sản phẩm du lịch,
                                dịch vụ địa phương. Danh mục sản phẩm toàn diện
                                của DEAH bao gồm các dịch vụ cũng như kho khách
                                sạn chỗ ở lớn nhất Việt Nam. Không chỉ vậy, để
                                giúp bạn thực hiện nhiều ước vọng về phong cách
                                sống của mình, chúng tôi còn hoàn thiện các dịch
                                vụ của mình với một loạt các điểm tham quan,
                                hoạt động địa phương . Vì vậy, bất kể lựa chọn
                                lối sống của bạn là gì, bạn chỉ cần một cú nhấp
                                chuột!
                            </p>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-6">
                            <p className="text-secondary font-semibold">
                                DEAH tin rằng hạnh phúc có thể đến dưới nhiều
                                hình thức đối với những người khác nhau trong
                                những thời điểm khác nhau. Vì vậy, với uy tín
                                của chúng tôi và kinh nghiệm hơn 5 năm, chúng
                                tôi hứa hẹn với bạn một loạt các lựa chọn phong
                                phú để thắp sáng trạng thái hạnh phúc của chính
                                bạn. Cho dù bạn đang tìm kiếm một trải nghiệm
                                thú vị hay nghỉ ngơi trong khu nghỉ dưỡng 5 sao
                                cho cả chuyến đi trong nước. Với dịch vụ chăm
                                sóc khách hàng 24/7, trở thành ứng dụng du lịch
                                và tiện ích sống phổ biến nhất ở Việt Nam. Bạn
                                còn chờ gì nữa? Đặt một chuyến đi được lên kế
                                hoạch chu đáo hoặc một kỳ nghỉ được quyết định
                                vào phút chót với chúng tôi. Với tất cả các lựa
                                chọn du lịch và phong cách sống độc đáo của bạn,
                                như mọi khi, DEAH sẽ đồng hành cùng bạn.
                            </p>
                        </div>
                        <div className="col-md-6">
                            <img
                                src="https://ik.imagekit.io/tvlk/image/imageResource/2022/10/31/1667232268871-776cfde10b5577c7b2d483fb04ced52f.png?tr=q-75"
                                width={400}
                                alt="Booking Du Lịch"
                            />
                        </div>
                    </div>
                </div>

                {/*/ End of Testimonial */}
                {/* Special area S t a r t */}
                <section className="special-area bottom-padding1">
                    <div className="container">
                        <div className="row justify-content-center">
                            <div className="col-xl-7 col-lg-7">
                                <div className="section-title mx-430 mx-auto text-center">
                                    <span className="highlights fancy-font font-400">
                                        Ưu đãi đặc biệt
                                    </span>
                                    <h4 className="title">
                                        mùa Đông Những Lời Đề Nghị Lớn Của Chúng
                                        Tôi Để Truyền Cảm Hứng Cho Bạn
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div className="row g-4">
                            <div className="col-lg-6 col-md-6">
                                <a
                                    href="tour-list"
                                    className="offer-banner imgEffect4 wow fadeInLeft"
                                    data-wow-delay="0.0s"
                                >
                                    <img
                                        src="https://png.pngtree.com/thumb_back/fw800/background/20240424/pngtree-travel-booking-concept-tourist-buying-tour-online-image_15665756.jpg"
                                        alt="travello"
                                    />
                                    <div className="offer-content">
                                        <p className="highlights-text">
                                            TiếtKiệmLênĐến
                                        </p>
                                        <h4 className="title">50%</h4>
                                        <p className="pera">
                                            Hãy Cùng Khám Phá Thế Giới
                                        </p>

                                        <div className="btn-secondary-sm radius-30">
                                            {" "}
                                            Đặt Phòng Ngay{" "}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div className="col-lg-6 col-md-6">
                                <a
                                    href="tour-list"
                                    className="offer-banner imgEffect4 wow fadeInLeft"
                                    data-wow-delay="0.0s"
                                >
                                    <img
                                        src="https://anyahotel.com/wp-content/uploads/2024/01/0-FACADE-VIEW-ANYA-PREMIER-Copy.jpg"
                                        alt="travello"
                                    />
                                    <div className="offer-content-two">
                                        <h4 className="title">
                                            Khách sạn gần đó
                                        </h4>
                                        <p className="pera">
                                            Up to{" "}
                                            <span className="highlights-text">
                                                50%
                                            </span>{" "}
                                            Tắt tốt nhất Khách sạn gần
                                        </p>

                                        <div className="btn-secondary-sm radius-30">
                                            {" "}
                                            Đặt Phòng Ngay
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                {/*/ End-of special*/}
            </main>
            {/* Footer S t a r t */}
            <Footer />
            <div className="progressParent" id="back-top">
                <svg
                    className="backCircle svg-inner"
                    width="100%"
                    height="100%"
                    viewBox="-1 -1 102 102"
                >
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                </svg>
            </div>
            <div className="search-overlay" />
        </div>
    );
};

export default About;