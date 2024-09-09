import React from 'react'
import { Link, useLocation } from 'react-router-dom';
import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';

const PaymentPage = () => {
    const location = useLocation();
    const { data } = location.state || {};
    const tableStyle: React.CSSProperties = {
        maxWidth: '800px',
        margin: 'auto',
      };
    return (
        <>
            {/* component */}
            <div className="bg-gray-100 h-screen">
                <div className="bg-white p-6  md:mx-auto">
                    <svg
                        viewBox="0 0 24 24"
                        className="text-green-600 w-16 h-16 mx-auto my-6"
                    >
                        <path
                            fill="currentColor"
                            d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z"
                        ></path>
                    </svg>
                    <div className="text-center">
                        <strong className="text-gray-600 my-3">
                            Cảm ơn quý khách đã đặt vé tại DEAH!
                        </strong>
                        <p className="text-gray-600 my-3">
                            Đơn hàng {data.booking_code} đã được tiếp nhận
                        </p>
                        <p className="text-gray-600">
                            Thông báo xác nhận đơn hàng sẽ gửi qua email của bạn
                            <br />
                            {data.email}
                        </p>
                        <div className="container mt-2">
                            <h2 className="mb-4">Vui lòng kiểm tra thông tin đặt vé và hóa đơn của bạn trước khi thanh toán.</h2>
                            <div className="table-responsive" style={tableStyle} >
                                <table className="table table-bordered table-hover">
                                    <thead className="thead-dark">
                                        <tr>
                                            <th>Đầu Mục</th>
                                            <th>Chi Tiết</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tour</td>
                                            <td>{data.tour_name}</td>
                                        </tr>
                                        <tr>
                                            <td>Khách Sạn</td>
                                            <td>- {data.hotel_name} -
                                                <br />
                                                Địa chỉ: {data.hotel_address}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Số Người</td>
                                            <td>Người lớn: {data.adults} Người
                                                <br />
                                                Trẻ từ 2 đến 5 tuổi: {data.children2To5} Người
                                                <br />
                                                Trẻ từ 6 đến 12 tuổi: {data.children6To12} Người
                                                <br />
                                                Tổng Khách Hàng: {data.people} Người
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ngày Bắt Đầu</td>
                                            <td>{data.start}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Ngày Kết Thúc</td>
                                            <td>{data.end}</td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Giá Tour</td>
                                            <td><CurrencyFormatter amount={data.tour_price} /></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Giá Khách Sạn</td>
                                            <td><CurrencyFormatter amount={data.hotel_price} /></td>
                                            
                                        </tr>
                                        <tr>
                                            <td>Tổng Thanh Toán</td>
                                            <td><CurrencyFormatter amount={data.total_price} /></td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <p className="text-gray-600 my-3">
                            Địa chỉ thanh toán: VinsHome,Cao Tốc Láng - Hòa Lạc, Tây Mỗ, Nam Từ Liêm, Hà Nội
                        </p>
                        <p className="text-red-400 my-3 fw-bold">
                            Lưu ý : Quý khách cần thanh toán trước thời gian khởi hành 1 tuần
                            <br />
                            Nếu không vé của quý khách sẽ bị huỷ.
                        </p>
                        <p> Chúc quý khách một ngày tốt lành!</p>
                        <div className=" text-center">
                            <Link to={'/'}>Trở lại trang chủ</Link>
                        </div>
                    </div>
                </div>
            </div>
        </>
    )
}
export default PaymentPage