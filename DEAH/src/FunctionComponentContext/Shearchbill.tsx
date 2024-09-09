import React, { useState } from 'react';
import axios from 'axios';
import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';
import Popup from '../FunctionComponentContext/Popup';
// Giả sử rằng bạn đã tạo component Popup ở đây

// Định nghĩa kiểu dữ liệu cho thông tin đơn hàng
interface OrderInfo {
  id: number;
  booking_code: string;
  phone: string;
  tour_id: number | null;
  user_id: number;
  tour_price: number;
  created_at: string;
  status_payment: number;
  status_tour: number;
  end:string;
  user_name:string;
}

const SearchListBill: React.FC = () => {
  const [booking_code, setBookingCode] = useState<string>('');
  const [orderInfo, setOrderInfo] = useState<OrderInfo | null>(null);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState<boolean>(false);

  const handleSearchClick = async () => {
    setLoading(true);
    try {
      const response = await axios.get(`${import.meta.env.VITE_BACKEND_URL}/api/client/get-booking/${booking_code}`);
      if (response.data.data && response.data.data.length > 0) {
        setOrderInfo(response.data.data[0]);
        setError(null);
      } else {
        setOrderInfo(null);
        setError('Không tìm thấy thông tin đơn hàng.');
      }
    } catch (error) {
      console.error('Error fetching order info:', error);
      setError('Có lỗi xảy ra hoặc mã đơn hàng không hợp lệ');
      setOrderInfo(null);
    } finally {
      setLoading(false);
    }
  };

  const formattedDate = (dateString: string): string => {
    const date = new Date(dateString);
    return date.toLocaleDateString('vi-VN', {
      year: 'numeric',
      month: '2-digit',
      day: '2-digit',
    });
  };

  const handleDelete = (bookingCode: string) => {
    // Thêm logic xóa ở đây
    console.log(`Deleting order with booking code: ${bookingCode}`);
  };

  return (
    <div>
      <div className="searchlistbill">
        <input
          className="col-6 mb-4"
          type="search"
          placeholder="Nhập mã đơn hàng"
          value={booking_code}
          onChange={(e) => setBookingCode(e.target.value)}
        />
        <button className="btn-xl" onClick={handleSearchClick} disabled={loading}>
          {loading ? 'Đang tìm kiếm...' : 'Tìm kiếm mã đơn hàng'}
        </button>
      </div>

      {error && <p className="text-danger">{error}</p>}

      {orderInfo && (
        <div className="shadow-2xl listbill">
          <table className="">
            <thead>
              <tr>
                <th>ID</th>
                <th>Mã Đơn Hàng</th>
                <th>tên khách hàng</th>
                <th>Giá</th>
                <th>Ngày Đặt</th>
                <th>Ngày kết thúc</th>
                <th>Hành Động</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{orderInfo.id}</td>
                <td>{orderInfo.booking_code}</td>
                <td> {orderInfo.user_name}</td>
                <td><CurrencyFormatter amount={orderInfo.tour_price} /></td>
                <td>{formattedDate(orderInfo.created_at)}</td>
                <td>{formattedDate(orderInfo.end)}</td>
              
              
                <td className='g-2 d-flex'>
                  <Popup item={orderInfo} />
                  {orderInfo.status_tour === 0 ? (
                    <i
                      role="button"
                      onClick={() => handleDelete(orderInfo.booking_code)}
                      className="ri-delete-bin-7-fill text-danger fs-4"
                    />
                  ) : ''}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
};

export default SearchListBill;

