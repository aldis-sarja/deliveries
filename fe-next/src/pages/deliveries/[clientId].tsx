import { useRouter } from "next/router";
import { NextPage } from "next";
import { Row } from "antd";
import { ReactNode } from "react";
import NavBar from "../../components/NavBar";

interface DeliveryLine {
  price: number;
  qty: number;
}

interface DeliveryRoute {
  date: string;
}

interface Delivery {
  type: number;
  status: number;
  delivery_lines: [DeliveryLine];
  route: DeliveryRoute;
}

interface Address {
  title: string;
  deliveries: [null | Delivery];
}

interface Client {
  id: number;
  name: string;
  phone: string;
  email: string;
  addresses: [Address];
}

function Deliveries({ client }) {
  // const Deliveries: NextPage<Client> = (client) => {
  const router = useRouter();

  if (router.isFallback) {
    return <h1>Loading data...</h1>;
  }

  return (
    <div>
      <NavBar />
      <Row>
        <div style={{ margin: "20px" }}>
          <h1>{client.name}</h1>
          <ul>
            <li>Email: {client.email}</li>
            <li>Phone: {client.phone}</li>
          </ul>
        </div>

        <div style={{ margin: "20px" }}>
          {client.addresses.map((address) => getDeliveries(address))}
        </div>
      </Row>
    </div>
  );
}

export async function getStaticProps(context) {
  const { params } = context;
  const res = await fetch(
    `${process.env.BACKEND_URL}/clients/${params.clientId}`
  );
  const data = await res.json();

  if (!data.id) {
    return {
      notFound: true,
    };
  }

  return {
    props: {
      client: data,
    },
  };
}

export async function getStaticPaths() {
  return {
    paths: [],
    fallback: true,
  };
}

function calculateSumm(deliveryLines: []) {
  const sum = deliveryLines.reduce(
    (sum, deliveryLine: DeliveryLine) =>
      sum + deliveryLine.price * deliveryLine.qty,
    0
  );
  return (sum / 100).toFixed(2);
}

function getDeliveries(address: Address): ReactNode {
  if (address.deliveries.length > 0) {
    return (
      <div>
        <h2>{address.title}</h2>
        <ul>
          {address.deliveries.map((delivery) => (
            <div>
              <h3>Datums: {delivery.route.date}</h3>
              <ul>
                <li>Summa: {calculateSumm(delivery.delivery_lines)} €</li>
                <li>Status: {getStatus(delivery.status)}</li>
              </ul>
            </div>
          ))}
        </ul>
      </div>
    );
  }

  return <></>;
}

function getStatus(n: number): string {
  switch (n) {
    case 1:
      return "Nav izpildīts";
    case 2:
      return "Ir izpildīts";
    case 3:
      return "Atcelts";
  }
  return "";
}

export default Deliveries;
