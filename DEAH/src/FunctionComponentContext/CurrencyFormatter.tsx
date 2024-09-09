import React from 'react';

interface CurrencyFormatterProps {
    amount: number;
}

const CurrencyFormatter: React.FC<CurrencyFormatterProps> = ({ amount }) => {
    const formatter = new Intl.NumberFormat('vi-VN', {
        currency: 'VND',
    });

    return <strong>{formatter.format(amount)} VND</strong>;
};

export default CurrencyFormatter;