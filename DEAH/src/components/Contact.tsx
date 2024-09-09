import Header from "./Header";
import Footer from "./Footer";
import myImage from '../assets/images/deahtourvn.jpg';
import myImage2 from '../assets/images/24480.jpg';
import myImage3 from '../assets/images/Group 1.png';
const Contact = () => {
    return (
        <div>
            <div>
                <Header status={true} />
                <main>
                    {/* Breadcrumbs S t a r t */}
                    <section className="breadcrumbs-area breadcrumb-bg">
                        <div className="container">
                            <h1
                                className="title wow fadeInUp"
                                data-wow-delay="0.0s"
                            >
                                Liên hệ
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
                                                Liên hệ
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </section>
                    {/*/ End-of Breadcrumbs*/}
                    {/* Contact area S t a r t */}
                    <section className="contact-area section-padding2">
                        <div className="container">
                            <div className="my-4">
                                <h1 className="title font-bold text-center h1">
                                    Chúng tôi luôn sẵn sàng, dù bạn ở
                                    bất cứ đâu
                                </h1>
                            </div>
                            <div className="my-5">
                                <h5>Xin chào bạn,</h5>
                                <h3>Chúng tôi có thể giúp gì cho bạn?</h3>
                            </div>
                            <div className="row">
                                <div className="col-12 col-lg-5 justify-content-center">
                                    <div className="container">
                                        <div className="row">
                                            <div className="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div className="panel panel-default">
                                                    <div className="panel-heading" role="tab" id="headingOne">
                                                        <div className="contact-card-2 my-4" id="specific-card">
                                                            <div className="d-flex h-30">
                                                                <div>
                                                                    {" "}
                                                                    <br />
                                                                    <img
                                                                        src=""
                                                                        alt=""
                                                                    />
                                                                </div>
                                                                <div>
                                                                    <br />
                                                                    <h3 className="">
                                                                        Hãy liên hệ với bộ phận dịch
                                                                        vụ khách hàng của chúng tôi
                                                                    </h3>
                                                                </div>
                                                            </div>
                                                            <br />
                                                            <div className="">
                                                                <p>
                                                                    Giờ hoạt động của Trung tâm chăm
                                                                    sóc khách hàng
                                                                </p>
                                                                <h5>
                                                                    Mở cửa: thứ hai - chủ nhật (từ 8
                                                                    giờ sáng - 10 giờ tối)
                                                                </h5>
                                                                <h5>
                                                                    Tin nhắn và email: Hoạt động
                                                                    24/7
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapseOne" className="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div className="panel-body">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="container">
                                        <div className="row">
                                            <div className="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div className="panel panel-default">
                                                    <div className="panel-heading" role="tab" id="headingOne">
                                                        <div className="contact-card-2 my-4" id="specific-card">
                                                            <div className="ml-[180px]">
                                                                <img
                                                                    className=" w-10 h-10"
                                                                    src="https://d1785e74lyxkqq.cloudfront.net/_next/static/v2/1/188abdc7fc85150e679c792210a76f17.svg"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div className="mb-4">
                                                                <br />
                                                                <h3 className="pt-1">
                                                                    Gọi cho bộ phận dịch vụ
                                                                    khách hàng của chúng tôi
                                                                </h3>
                                                                <p>(Hotline: 1990.0000 - 1990.1000)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="container">
                                        <div className="row">
                                            <div className="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div className="panel panel-default">
                                                    <div className="panel-heading" role="tab" id="headingOne">
                                                        <div className="contact-card-2 my-4" id="specific-card">
                                                            <div className="ml-[180px] mb-4">
                                                                <br />
                                                                <img
                                                                    width={50}
                                                                    src="https://d1785e74lyxkqq.cloudfront.net/_next/static/v2/4/41be2c783a998efde2181e7c2a1ccad5.svg"
                                                                    alt=""
                                                                />
                                                            </div>
                                                            <div>
                                                                <h3>
                                                                    Gửi thư điện tử cho bộ phận dịch
                                                                    vụ khách hàng của chúng tôi
                                                                </h3>
                                                                <p>(DEAH@gmail.com.vn)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapseOne" className="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                        <div className="panel-body">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent nisl lorem, dictum id pellentesque at, vestibulum ut arcu. Curabitur erat libero, egestas eu tincidunt ac, rutrum ac justo. Vivamus condimentum laoreet lectus, blandit posuere tortor aliquam vitae. Curabitur molestie eros. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="container">
                                        <div className="row">
                                            <div className="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                                <div className="panel panel-default">
                                                    <div className="panel-heading" role="tab" id="headingOne">
                                                        <div className="contact-card-2 my-4" id="specific-card">
                                                            <div className="contact-policy ">
                                                                <div className="row">
                                                                    <div className="">
                                                                        <h3>Điều khoản và điều kiện</h3>
                                                                        <ul className="">
                                                                            <li>
                                                                            Người dùng phải tuân thủ các quy định và điều khoản khi sử dụng dịch vụ.
                                                                            </li>
                                                                            <li>
                                                                            Cam kết bảo vệ thông tin cá nhân của khách hàng.
                                                                            </li>
                                                                            <li>
                                                                            Quy định về hủy dịch vụ và hoàn tiền
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div className="">
                                                                        <h3>Chính sách</h3>
                                                                        <ul className="">
                                                                            <li>
                                                                                Thời gian phản hồi trong 24 giờ làm
                                                                                việc
                                                                            </li>
                                                                            <li>
                                                                                Các kênh liên hệ: email, điện thoại,
                                                                                mạng xã hội
                                                                            </li>
                                                                            <li>
                                                                                Xử lý phản hồi và khiếu nại một cách
                                                                                nghiêm túc
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                    <div className="">
                                                                        <h3>Bảo hiểm</h3>
                                                                        <ul className="">
                                                                            <li>
                                                                                Bảo hiểm trách nhiệm nghề nghiệp
                                                                            </li>
                                                                            <li>Bảo hiểm bồi thường khách hàng</li>
                                                                            <li>Bảo hiểm tai nạn lao động</li>
                                                                        </ul>
                                                                    </div>
                                                                    <div className="">
                                                                        <h3>Dịch vụ khác</h3>
                                                                        <ul>
                                                                            <li>Tư vấn pháp lý</li>
                                                                            <li>Hỗ trợ kỹ thuật</li>
                                                                            <li>Chăm sóc khách hàng 24/7</li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-12 col-lg-7 my-4">
                                    <img src={myImage} />
                                    <img className="py-5" src={myImage2}/>
                                </div>
                                <img src={myImage3}/>
                            </div>

                        </div>
                    </section>
                    {/*/ End-of Contact*/}
                    {/* Map */}

                    {/* / Map */}
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
        </div>
    );
};

export default Contact;
