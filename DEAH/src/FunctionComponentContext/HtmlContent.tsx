import React from 'react';

interface HtmlToPlainTextProps {
  htmlContent: string;
}

const HtmlToPlainText: React.FC<HtmlToPlainTextProps> = ({ htmlContent }) => {
  // Tạo một đối tượng DOM từ đoạn mã HTML
  const tempElement = document.createElement('div');
  tempElement.innerHTML = htmlContent;

  // Lấy nội dung văn bản từ đối tượng DOM
  const plainText = tempElement.textContent || tempElement.innerText || '';

  return <span>{plainText}</span>;
};

export default HtmlToPlainText;
