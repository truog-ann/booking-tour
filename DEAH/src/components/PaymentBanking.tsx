import React from 'react'
import { useLocation } from 'react-router-dom';
import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';

const PaymentBanking = () => {
    const location = useLocation();
    const { data } = location.state || {};
    const tableStyle: React.CSSProperties = {
        maxWidth: '800px',
        margin: 'auto',
    };
    const handlePDF = (booking_code:any) => {
        const capture = document.querySelector('.pdfBill');
        html2canvas(capture as HTMLElement).then((canvas) => {
            const imgData = canvas.toDataURL('img/png');
            const doc = new jsPDF('p', 'mm', 'a4');
            const componentWidth = doc.internal.pageSize.getWidth();
            const componentHeight = doc.internal.pageSize.getHeight();
            doc.addImage(imgData, 'PNG', 0, 0, componentWidth, componentHeight)
            doc.save(booking_code + '.pdf')
        })
    }
    return (
        <>
            <div className="flex flex-col items-center justify-center min-h-screen bg-green dark:bg-green pdfBill">

                <div className="max-w-xl w-full space-y-6 p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800">
                    <div className="flex flex-col text-center items-center">
                        <CircleCheckIcon className="text-green-500 h-16 w-16" />
                        <h1 className="text-3xl font-bold text-gray-900 dark:text-gray-700 mt-4"></h1>
                        <p className="text-gray-700 dark:text-gray-400 mt-2">
                        </p>
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
                    </div>
                    <div className="border-t border-gray-200 dark:border-gray-700 pt-6 space-y-4">
                        <div className="flex justify-between">
                            <span className="text-black dark:text-gray-400">Số tài khoản:</span>
                            <span className="font-medium text-black dark:text-gray-50 ">19036343942015</span>
                        </div>
                        <div className="flex justify-between">
                            <span className="text-black dark:text-gray-400">Tên Chủ tài khoản</span>
                            <span className="font-medium text-black dark:text-gray-50">Trần Minh Thắng</span>
                        </div>
                        <div className="flex justify-between">
                            <span className="text-black dark:text-gray-400">Ngân Hàng:</span>
                            <span className="font-medium text-black dark:text-gray-50">Ngân hàng Kỹ Thương Techcombank</span>
                        </div>
                        <div className="flex justify-between">
                            <span className="text-black dark:text-gray-400">Giá:</span>
                            <span className="font-medium text-black dark:text-gray-50"> <CurrencyFormatter amount={data.total_price} /></span>
                        </div>
                        <div className="flex justify-between">
                            <span className="text-black dark:text-gray-400">Nội dung tài khoản:</span>
                            <span className="font-medium text-black dark:text-gray-50">DEAH{data.booking_code}</span>
                        </div>
                        <div className="flex justify-between">
                            <span className="text-black dark:text-gray-400">Mã hoá đơn:</span>
                            <span className="font-medium text-black dark:text-gray-50">{data.booking_code}</span>
                        </div>
                    </div>
                    <hr />
                    <div className="container mt-2">
                        <h2 className="mb-4">Hóa đơn của bạn</h2>
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
                    <div className="flex justify-around">
                        <a
                            className="btn btn-primary" href='/'
                        >
                            Quay lại trang chủ
                        </a>
                        <a
                            className="btn btn-warning" onClick={() => handlePDF(data.booking_code)}
                        >
                            Xuất hoá đơn
                        </a>
                    </div>
                </div>
            </div>
        </>
    )
}
function CircleCheckIcon(props: JSX.IntrinsicAttributes & React.SVGProps<SVGSVGElement>) {
    return (
        <svg
            {...props}
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            strokeWidth="2"
            strokeLinecap="round"
            strokeLinejoin="round"
        >
            <circle cx="12" cy="12" r="10" />
            <path d="m9 12 2 2 4-4" />
        </svg>
    )
}


export default PaymentBanking