// Test data for EEquiz - Circuit Tests
// Format: { id, variables, unknowns, formulas }

const CIRCUIT_TESTS = [
  {
    id: 1,
    variables: [
      "varI",
      "varR"
    ],
    unknowns: [
      "u"
    ],
    formulas: [
      "((varR)*(varI))"
    ]
  },
  {
    id: 2,
    variables: [
      "varI",
      "varU"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "((varU)/(varI))"
    ]
  },
  {
    id: 3,
    variables: [
      "varI",
      "varR"
    ],
    unknowns: [
      "u"
    ],
    formulas: [
      "((-1)*(varR)*(varI))"
    ]
  },
  {
    id: 4,
    variables: [
      "varI",
      "varV1",
      "varV2"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(((varV1)-(varV2))/(varI))"
    ]
  },
  {
    id: 5,
    variables: [
      "varV2",
      "varR",
      "varI"
    ],
    unknowns: [
      "V1"
    ],
    formulas: [
      "((varV2)+((varR)*(varI)))"
    ]
  },
  {
    id: 6,
    variables: [
      "varG",
      "varU"
    ],
    unknowns: [
      "i"
    ],
    formulas: [
      "((varG)*(varU))"
    ]
  },
  {
    id: 7,
    variables: [
      "varI",
      "varU"
    ],
    unknowns: [
      "G"
    ],
    formulas: [
      "((varI)/(varU))"
    ]
  },
  {
    id: 8,
    variables: [
      "varG",
      "varU"
    ],
    unknowns: [
      "i"
    ],
    formulas: [
      "((-1)*(varG)*(varU))"
    ]
  },
  {
    id: 9,
    variables: [
      "varI",
      "varG"
    ],
    unknowns: [
      "u"
    ],
    formulas: [
      "((-1)*((varI)/(varG)))"
    ]
  },
  {
    id: 10,
    variables: [
      "varG",
      "varV1",
      "varV2"
    ],
    unknowns: [
      "i"
    ],
    formulas: [
      "((varG)*((varV1)-(varV2)))"
    ]
  },
  {
    id: 11,
    variables: [
      "varI",
      "varV2",
      "varV1"
    ],
    unknowns: [
      "G"
    ],
    formulas: [
      "((varI)/((varV2)-(varV1)))"
    ]
  },
  {
    id: 12,
    variables: [
      "varV1",
      "varG",
      "varI"
    ],
    unknowns: [
      "V2"
    ],
    formulas: [
      "((varV1)-((varI)/(varG)))"
    ]
  },
  {
    id: 13,
    variables: [
      "varE"
    ],
    unknowns: [
      "u"
    ],
    formulas: [
      "(varE)"
    ]
  },
  {
    id: 14,
    variables: [
      "varU"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "((-1)*(varU))"
    ]
  },
  {
    id: 15,
    variables: [
      "varV2",
      "varV1"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "((varV2)-(varV1))"
    ]
  },
  {
    id: 16,
    variables: [
      "varV1",
      "varE"
    ],
    unknowns: [
      "V2"
    ],
    formulas: [
      "((varV1)-(varE))"
    ]
  },
  {
    id: 17,
    variables: [
      "varJ"
    ],
    unknowns: [
      "i"
    ],
    formulas: [
      "varJ"
    ]
  },
  {
    id: 18,
    variables: [
      "varI"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "varI"
    ]
  },
  {
    id: 19,
    variables: [
      "varI"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "((-1)*(varI))"
    ]
  },
  {
    id: 20,
    variables: [
      "varI",
      "varR",
      "varE"
    ],
    unknowns: [
      "u"
    ],
    formulas: [
      "(((varR)*(varI))-(varE))"
    ]
  },
  {
    id: 21,
    variables: [
      "varI",
      "varE",
      "varU"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(((varU)+(varE))/(varI))"
    ]
  },
  {
    id: 22,
    variables: [
      "varR",
      "varE",
      "varU"
    ],
    unknowns: [
      "I"
    ],
    formulas: [
      "(((varU)-(varE))/(varR))"
    ]
  },
  {
    id: 23,
    variables: [
      "varI",
      "varR",
      "varU"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "((varU)+((varR)*(varI)))"
    ]
  },
  {
    id: 24,
    variables: [
      "varI",
      "varR",
      "varV1",
      "varV2"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "((varV1)-(varV2)-((varR)*(varI)))"
    ]
  },
  {
    id: 25,
    variables: [
      "varI",
      "varR",
      "varE",
      "varV2"
    ],
    unknowns: [
      "V1"
    ],
    formulas: [
      "((varV2)-((varR)*(varI))+(varE))"
    ]
  },
  {
    id: 26,
    variables: [
      "varE",
      "varV1",
      "varV2",
      "varI"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(((varV1)-(varV2)-(varE))/(varI))"
    ]
  },
  {
    id: 27,
    variables: [
      "varI",
      "varG",
      "varE"
    ],
    unknowns: [
      "U"
    ],
    formulas: [
      "(-((varI)/(varG))-(varE))"
    ]
  },
  {
    id: 28,
    variables: [
      "varI",
      "varE",
      "varU"
    ],
    unknowns: [
      "G",
      "U1"
    ],
    formulas: [
      "((varI)/(varU))",
      "((varU)-(varE))"
    ]
  },
  {
    id: 29,
    variables: [
      "varG",
      "varE",
      "varV1",
      "varV2"
    ],
    unknowns: [
      "I"
    ],
    formulas: [
      "(((varV2)-(varV1)+(varE))*(varG))"
    ]
  },
  {
    id: 30,
    variables: [
      "varV1",
      "varI",
      "varG",
      "varE"
    ],
    unknowns: [
      "varV2"
    ],
    formulas: [
      "((varV1)-((varI)/(varG))-(varE))"
    ]
  },
  {
    id: 31,
    variables: [
      "varI",
      "varG",
      "varV1",
      "varV2"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "((varV1)-(varV2)-((varI)/(varG)))"
    ]
  },
  {
    id: 32,
    variables: [
      "varJ",
      "varR"
    ],
    unknowns: [
      "U"
    ],
    formulas: [
      "((varR)*(varJ))"
    ]
  },
  {
    id: 33,
    variables: [
      "varJ",
      "varU"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(-(varU)/(varJ))"
    ]
  },
  {
    id: 34,
    variables: [
      "varJ",
      "varR"
    ],
    unknowns: [
      "U"
    ],
    formulas: [
      "((varR)*(varJ))"
    ]
  },
  {
    id: 35,
    variables: [
      "varU",
      "varR"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "((varU)/(varR))"
    ]
  },
  {
    id: 36,
    variables: [
      "varV1",
      "varJ",
      "varR"
    ],
    unknowns: [
      "V2"
    ],
    formulas: [
      "((varV1)+((varR)*(varJ)))"
    ]
  },
  {
    id: 37,
    variables: [
      "varJ",
      "varU"
    ],
    unknowns: [
      "G"
    ],
    formulas: [
      "((varJ)/(varU))"
    ]
  },
  {
    id: 38,
    variables: [
      "varV1",
      "varV2",
      "varG"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "((varG)*((varV1)-(varV2)))"
    ]
  },
  {
    id: 39,
    variables: [
      "varG",
      "varJ",
      "varV2"
    ],
    unknowns: [
      "V1"
    ],
    formulas: [
      "((varV2)-((varJ)/(varG)))"
    ]
  },
  {
    id: 40,
    variables: [
      "varR",
      "varE"
    ],
    unknowns: [
      "I"
    ],
    formulas: [
      "(-(varE)/(varR))"
    ]
  },
  {
    id: 41,
    variables: [
      "varE",
      "varR"
    ],
    unknowns: [
      "I"
    ],
    formulas: [
      "((varE)/(varR))"
    ]
  },
  {
    id: 42,
    variables: [
      "varE",
      "varI"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(-(varE)/(varI))"
    ]
  },
  {
    id: 43,
    variables: [
      "varI",
      "varE"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "((varE)/(varI))"
    ]
  },
  {
    id: 44,
    variables: [
      "varR",
      "varI"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "((varR)*(varI))"
    ]
  },
  {
    id: 45,
    variables: [
      "varR",
      "varI"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "(-(varR)*(varI))"
    ]
  },
  {
    id: 46,
    variables: [
      "varJ",
      "varR"
    ],
    unknowns: [
      "U"
    ],
    formulas: [
      "((varR)*(varJ))"
    ]
  },
  {
    id: 47,
    variables: [
      "varJ",
      "varU"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(-(varU)/(varJ))"
    ]
  },
  {
    id: 48,
    variables: [
      "varR",
      "varU"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "(-(varU)/(varR))"
    ]
  },
  {
    id: 49,
    variables: [
      "varR",
      "varU"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "((varU)/(varR))"
    ]
  },
  {
    id: 50,
    variables: [
      "varR",
      "varU",
      "varJ"
    ],
    unknowns: [
      "E"
    ],
    formulas: [
      "(-(varU)-((varR)*(varJ)))"
    ]
  },
  {
    id: 51,
    variables: [
      "varE",
      "varU",
      "varJ"
    ],
    unknowns: [
      "R"
    ],
    formulas: [
      "(((varU)+(varE))/(varJ))"
    ]
  },
  {
    id: 52,
    variables: [
      "varR",
      "varE",
      "varU"
    ],
    unknowns: [
      "J"
    ],
    formulas: [
      "(((varE)-(varU))/(varR))"
    ]
  },
  {
    id: 53,
    variables: [
      "varR",
      "varU",
      "varJ"
    ],
    unknowns: [
      "I"
    ],
    formulas: [
      "((varJ)+((varU)/(varR)))"
    ]
  },
  {
    id: 54,
    variables: [
      "varI1",
      "varI2",
      "varI3"
    ],
    unknowns: [
      "I1",
      "I2",
      "I3",
      "I4"
    ],
    formulas: [
      "(-(varI1))",
      "((varI2)+(varI3))",
      "((varI2)+(varI3)-(varI1))",
      "((varI3)-(varI1))"
    ]
  },
  {
    id: 55,
    variables: [
      "varI1",
      "varI2",
      "varI3",
      "varI4"
    ],
    unknowns: [
      "I1",
      "I3",
      "I4",
      "I5"
    ],
    formulas: [
      "(-(varI2)+(varI1))",
      "((varI3)-(varI4))",
      "((varI3)-(varI4)-(varI1))",
      "((varI3)-(varI2))"
    ]
  },
  {
    id: 56,
    variables: [
      "varI1",
      "varI2",
      "varI3",
      "varI4"
    ],
    unknowns: [
      "I1",
      "I2",
      "I3",
      "I4"
    ],
    formulas: [
      "((varI1)-(varI2))",
      "((varI3)-(varI1)+(varI2))",
      "((varI4)-(varI3)-(varI2))",
      "((varI4)-(varI3))"
    ]
  },
  {
    id: 57,
    variables: [
      "varI1",
      "varI2",
      "varI3",
      "varI4"
    ],
    unknowns: [
      "I1",
      "I2",
      "I3",
      "I4"
    ],
    formulas: [
      "((varI1)+(varI3)-(varI4)+(varI2)-(varI1))",
      "((varI3)-(varI4)+(varI2)-(varI1))",
      "((varI2)-(varI1))",
      "((varI4)-(varI2)+(varI1))"
    ]
  },
  {
    id: 58,
    variables: [
      "varI1",
      "varI2",
      "varI3",
      "varI4",
      "varI5"
    ],
    unknowns: [
      "I1",
      "I2",
      "I3",
      "I4",
      "I5"
    ],
    formulas: [
      "((varI1)-(varI2))",
      "((varI1)-(varI2)+(varI5))",
      "((varI2)-(varI4)-(varI5)-(varI3))",
      "((varI4)+(varI5)+(varI3))",
      "((varI4)+(varI5))"
    ]
  },
  {
    id: 59,
    variables: [
      "varU1",
      "varU2",
      "varU3",
      "varU4"
    ],
    unknowns: [
      "U1",
      "U2",
      "U3"
    ],
    formulas: [
      "((varU3)+(varU2)+(varU1)-(varU2)+(varU4))",
      "(-(varU1)+(varU2)-(varU4))",
      "((varU1)-(varU2))"
    ]
  },
  {
    id: 60,
    variables: [
      "varU1",
      "varU2",
      "varU3",
      "varU4"
    ],
    unknowns: [
      "U1",
      "U2",
      "U3",
      "U4"
    ],
    formulas: [
      "((varU1)+(varU2))",
      "((varU1)-(varU3)+(varU4))",
      "(-(varU2)-(varU3))",
      "(-(varU2)-(varU3)+(varU4))"
    ]
  },
  {
    id: 61,
    variables: [
      "varU1",
      "varU2",
      "varU3",
      "varU4"
    ],
    unknowns: [
      "U1",
      "U2",
      "U3",
      "U4"
    ],
    formulas: [
      "(-(varU1)-(varU2))",
      "((varU1)+(varU2)+(varU3))",
      "((varU4)-(varU3))",
      "((varU4)-(varU3)-(varU2))"
    ]
  },
  {
    id: 62,
    variables: [
      "varU1",
      "varU2",
      "varU3",
      "varU4"
    ],
    unknowns: [
      "U1",
      "U2",
      "U3",
      "U4"
    ],
    formulas: [
      "((varU1)+(varU2))",
      "((varU3)+(varU2))",
      "((varU3)+(varU4))",
      "((varU1)+(varU4))"
    ]
  },
  {
    id: 63,
    variables: [
      "varU1",
      "varU2",
      "varU3",
      "varU4",
      "varU5"
    ],
    unknowns: [
      "U1",
      "U2",
      "U3",
      "U4",
      "U5"
    ],
    formulas: [
      "(-(varU4)+(varU5))",
      "((varU3)+(varU4))",
      "((varU3)+(varU2))",
      "(-(varU2)+(varU1))",
      "((varU1)-(varU5))"
    ]
  }
];

// Note: Tests 1-53 are for circuits, and likely some tests continue for graphs
// This data structure makes it easy to select random tests
