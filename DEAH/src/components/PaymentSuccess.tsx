
import React, { useEffect, useState } from 'react'

import { JSX } from 'react/jsx-runtime'
import CurrencyFormatter from '../FunctionComponentContext/CurrencyFormatter';
import axios from 'axios';
import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import { format, parse } from 'date-fns';
const PaymentSuccess = () => {
  const [params, setParams] = useState<any>({});

  const user_payment_info = JSON.parse(sessionStorage.getItem('user_payment_info')!);
  console.log(user_payment_info);

  const updatePaymentState = async (vnp_TxnRef: any) => {

    const response = await axios.post(`${import.meta.env.VITE_BACKEND_URL}/api/client/update-payment-status/${vnp_TxnRef}`, {
      'status_payment': 1
    })
    console.log(response);
    return response;
  }
  useEffect(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const paramsObject: { [key: string]: any } = {};
    for (let [key, value] of urlParams.entries()) {
      paramsObject[key] = value;
    }

    paramsObject.vnp_PayDate = parse(paramsObject.vnp_PayDate, 'yyyyMMddHHmmss', new Date());

    // Format the date using date-fns
    paramsObject.vnp_PayDate = format(paramsObject.vnp_PayDate, 'PPpp'); // Example: Aug 16, 2024, 2:33:08 PM
    setParams(paramsObject);

    if (paramsObject.vnp_ResponseCode !== '00') {
      console.log(paramsObject, '1');

      // setTimeout(() => {
      //   window.location.href = '/';
      // }, 3000);   
    } else {
      console.log(paramsObject, '2');
      updatePaymentState(paramsObject.vnp_TxnRef);

    }

  }, []);

  const handlePDF = (booking_code: any) => {
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
      <div className="flex flex-col items-center justify-center min-h-screen bg-green dark:bg-green">
        <div className="max-w-xl w-full space-y-6 p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 pdfBill">
          <div className="flex flex-col items-center">
            {params.vnp_ResponseCode == '00' ? <CircleCheckIcon className="text-green-500 h-16 w-16" /> : <ErrorIcon />}
            <h1 className="text-3xl font-bold text-gray-900 dark:text-gray-700 mt-4">{params.vnp_ResponseCode == '00' ? 'Thanh Toán Thành công' : 'Thanh Toán Không Thành Công'}</h1>
            <p className="text-gray-700 dark:text-gray-400 mt-2">
              {params.vnp_ResponseCode == '00' ? 'Cảm ơn vì đã thanh toán. Tour du lịch của bạn đã được đặt chỗ.' : `Thanh toán không thành công. Vui lòng thử lại sau.`}
            </p>
            {params.vnp_ResponseCode != '00' && <a
              className="btn btn-primary" href='/'
            >
              Quay lại trang chủ
            </a>}

          </div>
          {params.vnp_ResponseCode == '00' &&
            <>
              <div className="border-t border-gray-200 dark:border-gray-700 pt-6 space-y-4">
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Họ và tên:</span>
                  <span className="font-medium text-black dark:text-gray-50">{user_payment_info.user_name}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Email:</span>
                  <span className="font-medium text-black dark:text-gray-50">{user_payment_info.email}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Số điện thoại</span>
                  <span className="font-medium text-black dark:text-gray-50">{user_payment_info.phone}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Giá:</span>
                  <span className="font-medium text-black dark:text-gray-50">{<CurrencyFormatter amount={(params.vnp_Amount) / 100} />}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Phương thức thanh toán:</span>
                  <span className="font-medium text-black dark:text-gray-50">VNPay</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Ngày đi:</span>
                  <span className="font-medium text-black dark:text-gray-50">{user_payment_info.start}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Ngày về:</span>
                  <span className="font-medium text-black dark:text-gray-50">{user_payment_info.end}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Ngày đặt:</span>
                  <span className="font-medium text-black dark:text-gray-50">{params.vnp_PayDate}</span>
                </div>
                <div className="flex justify-between">
                  <span className="text-black dark:text-gray-400">Mã hoá đơn:</span>
                  <span className="font-medium text-black dark:text-gray-50">{params.vnp_TxnRef}</span>
                </div>
              </div>
              <div className="flex justify-around">
                <a
                  className="btn btn-primary" href='/'
                >
                  Quay lại trang chủ
                </a>
                <a
                  className="btn btn-warning"
                  onClick={() => handlePDF(params.vnp_TxnRef)}
                >
                  Xuất hoá đơn
                </a>
              </div>
            </>

          }

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

const ErrorIcon = () => (
  <svg className="text-green-500 h-16 w-16"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 24 24"
    width="40"
    height="40"
    fill="red"

  >

    <path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm0 18c-.828 0-1.5-.672-1.5-1.5S11.172 15 12 15s1.5.672 1.5 1.5S12.828 18 12 18zm1-4h-2V7h2v7z" />
  </svg>
);

export default PaymentSuccess