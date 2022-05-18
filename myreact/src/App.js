import logo from "./logo.svg";
import "./App.css";
import { useState, useCallback } from "react";
import React, { Component } from "react";
import {
  TextField,
  FormLayout,
  Select,
  Checkbox,
  Card,
  ButtonGroup,
  Button,
  Frame,
  ContextualSaveBar,
  Stack,
  Heading,
  ChoiceList,
  TextStyle,
  InlineError,
  ColorPicker,
} from "@shopify/polaris";

function App() {
  // TextField
  const [value, setValue] = useState("");
  const [showColor, setShowColor] = useState(false);

  const handleChange = useCallback((newValue) => setValue(newValue), []);

  const [value1, setValue1] = useState("");
  const handleChange1 = useCallback((newValue) => setValue1(newValue), []);

  const [value2, setValue2] = useState("");
  const handleChange2 = useCallback((newValue) => setValue2(newValue), []);
  //Select
  const [selectedDelivery, setSelectedDelivery] = useState("");
  const handleSelectChangeDelivery = useCallback(
    (value) => setSelectedDelivery(value),
    []
  );
  const [selectedCalendar, setSelectedCalendar] = useState("");
  const handleSelectChangeCalendar = useCallback(
    (value) => setSelectedCalendar(value),
    []
  );
  const [selected, setSelected] = useState();
  const handleSelectChange = useCallback((value) => setSelected(value), []);
  const options = [
    { label: "Newest update", value: "newestUpdate" },
    { label: "Oldest update", value: "oldestUpdate" },
    { label: "Most spent", value: "mostSpent" },
    { label: "Most orders", value: "mostOrders" },
    { label: "Last name A–Z", value: "lastNameAlpha" },
    { label: "Last name Z–A", value: "lastNameReverseAlpha" },
  ];

  const [color, setColor] = useState({
    hue: 50,
    brightness: 0.5,
    saturation: 0.5,
  });

  const [color1, setColor1] = useState({
    hue: 120,
    brightness: 1,
    saturation: 1,
  });

  function generateErrorMessage() {
    const weightError = !selectedDelivery ? "The numeric of the product " : "";
    if (selectedDelivery) {
      //|| selectedCalendar || selected
      return "";
    }

    return (
      <span>
        <TextStyle variation="negative">
          <p>
            {`${weightError} is required. `}
            {/* <Link>Manage shipping</Link> */}
          </p>
        </TextStyle>
      </span>
    );
  }

  function generateErrorMessage1() {
    const weightError = !selectedCalendar ? "The numeric of the product " : "";
    if (selectedCalendar) {
      //|| selectedCalendar || selected
      return "";
    }

    return (
      <span>
        <TextStyle variation="negative">
          <p>
            {`${weightError} is required. `}
            {/* <Link>Manage shipping</Link> */}
          </p>
        </TextStyle>
      </span>
    );
  }
  function generateErrorMessage2() {
    const weightError = !selected ? "The numeric of the product " : "";
    if (selected) {
      //|| selectedCalendar || selected
      return "";
    }

    return (
      <span>
        <TextStyle variation="negative">
          <p>
            {`${weightError} is required. `}
            {/* <Link>Manage shipping</Link> */}
          </p>
        </TextStyle>
      </span>
    );
  }
  const errorMessage = generateErrorMessage();
  const errorMessage1 = generateErrorMessage1();
  const errorMessage2 = generateErrorMessage2();
  //Checkbox
  const [checked, setChecked] = useState(false);
  const handleChangeCheckbox = useCallback(
    (newChecked) => setChecked(newChecked),
    []
  );
  //ChoiceList
  const [selectedChoice, setSelectedChoice] = useState(["hidden"]);

  const handleChangeChoice = useCallback(
    (value) => setSelectedChoice(value),
    []
  );
  function handleChangeColor(value) {
    console.log("value", value);
    const tempColor = {
      hue: value.hue,
      brightness: value.brightness,
      saturation: value.saturation,
    };
    console.log({ tempColor });
    setColor(tempColor);
    setShowColor(false);
    setValue(
      `hsl(${tempColor.hue},${tempColor.saturation * 100}%, ${
        tempColor.brightness * 100
      }%)`
    );
  }
  function OnSave() {
    const data = {};
    data.themeColor = value;
    console.log(data);
  }
  // Color picker
  return (
    <div className="App">
      <div className="App-Form">
        <FormLayout>
          <card>
            <ButtonGroup>
              <Button id="redButton">Display</Button>
              <Button id="darkButton" primary>
                Rule
              </Button>
            </ButtonGroup>
            <div id="color-select">
              <div>
                <TextField
                  label="Theme Color"
                  value={value}
                  onChange={handleChange}
                  autoddComplete="off"
                  // suffix={<input type="color" value="#ff0000"></input>}
                />
                <div
                  className="color-picker"
                  onClick={function () {
                    setShowColor(true);
                  }}
                  style={{
                    background: `hsl(${color.hue},${color.saturation * 100}%, ${
                      color.brightness * 100
                    }%)`,
                  }}
                ></div>
                {showColor && (
                  <div>
                    <ColorPicker onChange={handleChangeColor} color={color} />
                  </div>
                )}
              </div>
              <div>
                <TextField
                  label="Notifications text color"
                  value={value1}
                  onChange={handleChange1}
                  autoComplete="off"
                  suffix={<input type="color" value="#ff0000"></input>}
                />
              </div>
            </div>
            <Select
              id="unitSelectID"
              label="Delivery date layout"
              placeholder="Select"
              options={options}
              onChange={handleSelectChangeDelivery}
              value={selectedDelivery}
              error={Boolean(!selectedDelivery)}
            />
            <InlineError message={errorMessage} fieldID="unitSelectID" />
            <Select
              id="unitSelectID1"
              label=" Calendar language "
              placeholder="Select"
              options={options}
              onChange={handleSelectChangeCalendar}
              value={selectedCalendar}
              error={Boolean(!selectedCalendar)}
            />
            <InlineError message={errorMessage} fieldID="unitSelectID1" />
            <Select
              id="unitSelectID2"
              label="Fist day of calendar"
              placeholder="Select"
              options={options}
              onChange={handleSelectChange}
              value={selected}
              error={Boolean(!selected)}
            />

            <InlineError message={errorMessage} fieldID="unitSelectID2" />
            <div id="ChoiceList">
              <ChoiceList
                allowMultiple
                // title="While the customer is checking out"
                choices={[
                  {
                    label: "Show the calendar at the product page",
                    value: "shipping",
                  },
                  {
                    label: "Require the delivery date before checkout",
                    value: "confirmation",
                  },
                ]}
                selected={selectedChoice}
                onChange={handleChangeChoice}
              />
            </div>
            <div>
              <Card sectioned>
                <Stack>
                  <Heading>Order #1136</Heading>
                </Stack>
                <TextField
                  label="Delivery date label"
                  value={value2}
                  onChange={handleChange2}
                  autoComplete="off"
                />
              </Card>
            </div>
            <div id="Frames">
              <Frame
                logo={{
                  width: 124,
                  contextualSaveBarSource:
                    "https://cdn.shopify.com/s/files/1/0446/6937/files/jaded-pixel-logo-gray.svg?6215648040070010999",
                }}
              >
                <ContextualSaveBar
                  message="Unsaved changes"
                  saveAction={{
                    onAction: () => OnSave(),
                    loading: false,
                    disabled: false,
                    content: "Save",
                  }}
                  discardAction={{
                    onAction: () => console.log("add clear form logic"),
                    content: "Discard",
                  }}
                  alignContentFlush={false}
                />
              </Frame>
            </div>
          </card>
        </FormLayout>
      </div>
    </div>
  );
}

export default App;
